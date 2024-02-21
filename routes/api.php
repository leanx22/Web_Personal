<?php

use App\Http\Controllers\API_ProjectController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\GeneralStatsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserSlimController;
use Illuminate\Http\Request;
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
    Route::get('/projects/search/{search}','show');
    Route::get('/projects/links/{search}','getLinksOfProject');
    Route::get('/projects/stats/{search}','getStatsOfProject');

    Route::middleware('JWT.Auth')
    ->group(function()
    {    
        Route::post('/projects/store','store');
        Route::post('/projects/update','update'); //Podría ser PUT o PATCH
        Route::delete('/projects/destroy/{search}','destroy');    
        Route::post('/projects/saveInteraction','changeProjectStat')->middleware('throttle:project_interaction_rl');   
    });

});

route::controller(GeneralStatsController::class)
->group(function(){
    Route::post('/restartStat','restartStat')->middleware('JWT.Auth');
    Route::post('/saveGeneralView','newGeneralView')->middleware('throttle:viewstat_rl');
    Route::post('/saveInteraction','newInteraction')->middleware('throttle:interaction_rl');
});

//RL?
Route::post('/saveContactInfo',[ContactFormController::class,'store']);
