<?php

namespace App\Services;

use App\Enums\StatusTransacao;
use App\Enums\TipoTransacao;
use App\Models\Carteira;
use App\Models\Transacao;
use Exception;

class PagamentoService
{
    private function debitarCarteira(int $userID, string $valor): bool
    {
        $carteira = Carteira::where('user_id', $userID)->lockForUpdate()->firstOrFail();

        if (bccomp($carteira->saldo, $valor, 2) === -1) {
            return false;
        }

        $carteira->decrement('saldo', $valor);

        return true;
    }

    public function reterValor(int $userID, string $valor, int $pedidoCaronaID): void
    {
        if (! $this->debitarCarteira($userID, $valor)) {
            Transacao::create([
                'user_id' => $userID,
                'pedido_carona_id' => $pedidoCaronaID,
                'tipo' => TipoTransacao::RETENCAO,
                'status' => StatusTransacao::FALHOU,
                'valor' => $valor,
            ]);

            throw new Exception('Saldo insuficiente para garantir a vaga da carona.');
        }

        Transacao::create([
            'user_id' => $userID,
            'pedido_carona_id' => $pedidoCaronaID,
            'tipo' => TipoTransacao::RETENCAO,
            'status' => StatusTransacao::SUCESSO,
            'valor' => $valor,
        ]);
    }

    public function depositarValor(int $userID, string $valor): void
    {
        $carteira = Carteira::where('user_id', $userID)->lockForUpdate()->firstOrFail();
        $carteira->increment('saldo', $valor);
        Transacao::create([
            'user_id' => $userID,
            'tipo' => TipoTransacao::DEPOSITO,
            'status' => StatusTransacao::SUCESSO,
            'valor' => $valor,
        ]);
    }
}
