<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()){
            return redirect()->route('index');
        }
    
        if (auth()->user()->role !== $role){
            return redirect()->route('/')>with('error', 'Acesso negado. Você não tem permissão para acessar esta área.');
        }


        return $next($request);
    }
}