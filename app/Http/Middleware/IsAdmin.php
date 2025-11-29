<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se está logado E se é admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Se não for admin, redireciona para a home (área do membro) com erro
        return redirect('/home')->with('error', 'Acesso restrito à liderança.');
    }
}