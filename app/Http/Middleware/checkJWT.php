<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
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
        $token = $request->bearerToken();
        $decoded = LoginController::checkToken($token);

        if($decoded != null && $decoded != false){
            $request->merge(['JWT' => $decoded]);
            $request->headers->remove('Authorization');
            return $next($request);
        }
        
        return response()->json(["message"=>"No se pudo autenticar"])->setStatusCode(401);
    }
}
