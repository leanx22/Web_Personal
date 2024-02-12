<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserSlimController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(UserSlimController::checkToken($request->_JWT)){
        return $next($request);
        }
        return redirect()->route('login');
    }
}
