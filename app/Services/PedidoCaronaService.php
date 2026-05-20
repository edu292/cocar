<?php

namespace App\Services;

use App\DataTransferObjects\PedidoCaronaEstimativa;
use App\Enums\FaseCarona;
use App\Enums\StatusCarona;
use App\Exceptions\ExibivelException;
use App\Models\PedidoCarona;
use App\Models\User;
use App\ValueObjects\Point;
use Illuminate\Support\Facades\DB;

class PedidoCaronaService
{
    private string $custoKmMax = '3';

    private string $custoKmMin = '2';

    public function __construct(protected MapApiService $mapApiService, protected PagamentoService $pagamentoService) {}

    public function estimativaCusto(Point $origem, Point $destino, User $user): PedidoCaronaEstimativa
    {
        $result = $this->mapApiService->obterRotaDireta($origem, $destino);
        $distanciaMetros = $result->routes[0]->distance;
        $distanciaKm = bcdiv((string) $distanciaMetros, '1000', 2);

        $min = bcmul($distanciaKm, $this->custoKmMin, 2);
        $max = bcmul($distanciaKm, $this->custoKmMax, 2);
        $saldo = $user->carteira->saldo;

        return new PedidoCaronaEstimativa(
            min: $min,
            max: $max,
            saldoUsuario: $saldo,
            saldoUsuarioSuficiente: bccomp($saldo, $max, 2) >= 0
        );
    }

    public function novoPedido(array $dados, User $user): PedidoCarona
    {
        if ($user->caronas()->whereIn('status', StatusCarona::naFase(FaseCarona::ATIVA))->exists()) {
            throw new ExibivelException('Usuário já possui um pedido em andamento');
        }

        $estimativa = $this->estimativaCusto($dados['origem_coords'], $dados['destino_coords'], $user);

        if (! $estimativa->saldoUsuarioSuficiente) {
            throw new ExibivelException('Saldo insuficiente');
        }

        return DB::transaction(function () use ($dados, $user, $estimativa) {
            $pedidoCarona = $user->pedidosCarona()->create($dados);

            $this->pagamentoService->reterValor($user->id, $estimativa->max, $pedidoCarona->id);

            return $pedidoCarona;
        });
    }
}
