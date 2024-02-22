<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('viewstat_rl', function (Request $request){
            return Limit::perMinutes(10,1)->response(function (Request $request){
                return response()->json(["message"=>"View already register some minutes ago."])->setStatusCode(429);
            })->by($request->ip());
        });

        RateLimiter::for('interaction_rl', function (Request $request){
            $key = $request->ip().$request->interaction;
            return Limit::perMinutes(10,1)->response(function (Request $request){
                return response()->json(["message"=>"That interaction was already registered some minutes ago."])->setStatusCode(429);
            })->by($key);
        });

        RateLimiter::for('project_interaction_rl', function (Request $request){
            if(!$request->project || !$request->type)
            {
                return response()->json(["message"=>"Falta informacion en la request"])->setStatusCode(422);
            }
            $key = $request->ip().$request->project.$request->type;
            return Limit::perMinutes(10,1)->response(function (Request $request){
                return response()->json(["message"=>"That project's interaction was already registered some minutes ago."])->setStatusCode(429);
            })->by($key);
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
