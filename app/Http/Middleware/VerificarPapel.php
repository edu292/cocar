<?php

namespace App\Http\Middleware;

use App\Enums\PapelUsuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarPapel
{
    public function handle(Request $request, Closure $next, string $papel): Response
    {
        if (! Auth::check()) {
            return redirect()->route('inicio');
        }

        $papelNecessario = PapelUsuario::from($papel);

        if (Auth::user()->papel !== $papelNecessario) {
            return redirect()
                ->route('home')
                ->with('error', 'Acesso negado. Você não tem permissão para acessar esta área.');
        }

        return $next($request);
    }
}
