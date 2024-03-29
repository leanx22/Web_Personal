<?php

use App\Http\Controllers\API_ProjectController;
use App\Http\Controllers\API_projectLinkController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\GeneralStatsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

route::controller(LoginController::class)
->group(function(){

    Route::post('/getJWT','loginAPI');
    Route::get('/session/exit','logOut');

});

route::controller(API_ProjectController::class)
->group(function(){

    Route::get('/projects','index');
    Route::get('/projects/{search}','show');

    Route::middleware('JWT.Auth')
    ->group(function()
    {    
        Route::post('/projects/store','store');
        Route::post('/projects/update','update'); //Podría ser PUT o PATCH
        Route::post('/projects/destroy','destroy');    
        Route::post('/projects/saveInteraction','changeProjectStat')->middleware('throttle:project_interaction_rl');   
    });

});

route::controller(GeneralStatsController::class)
->group(function(){
    Route::post('/restartStat','restartStat')->middleware('JWT.Auth');
    Route::post('/saveGeneralView','newGeneralView')->middleware('throttle:viewstat_rl');
    Route::post('/saveInteraction','newInteraction')->middleware('throttle:interaction_rl');
});

route::controller(StatsController::class)
->group(function(){
    route::post('/projects/stats/increment','incrementStat')->middleware('throttle:project_interaction_rl', 'separate.project');
    Route::get('/projects/stats/{search}','getStats');
});

route::controller(API_projectLinkController::class)
->group(function(){

    Route::get('/projects/links/{search}','getLinksOfProject');    

});

//RL?
Route::post('/saveContactInfo',[ContactFormController::class,'store']);
