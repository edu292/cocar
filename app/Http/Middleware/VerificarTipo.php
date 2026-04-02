<?php

namespace App\Http\Middleware;

use App\Enums\TipoUsuario;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarTipo
{
    /**
     * @param  Closure(): void  $next
     */
    public function handle(Request $request, Closure $next, string $papel): Response
    {
        $tipo = TipoUsuario::tryFrom($papel);

        if ($request->user()->papel !== $tipo) {
            return redirect()
                ->route('home')
                ->with('error', 'Acesso negado. Você não tem permissão para acessar esta área.');
        }

        return $next($request);
    }

    public static function com(TipoUsuario $tipo): string
    {
        return 'tipo:'.$tipo->value;
    }
}
