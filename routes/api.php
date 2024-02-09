<?php

use App\Http\Controllers\API_ProjectController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\GeneralStatsController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

route::controller(API_ProjectController::class)
->group(function(){

    Route::get('/projects','getAllPublicProjects');
    Route::get('/projects/{search}','getProjectData');

    Route::get('/projects/links/{search}','getLinksOfProject');
    Route::get('/projects/stats/{search}','getStatsOfProject');

    Route::post('/projects/saveInteraction','changeProjectStat')->middleware('throttle:project_interaction_rl');

});

//Se necesita autentificacion! -> probablemente con jwt/firebase estaría.
Route::post('/restartStat',[GeneralStatsController::class,'restartStat']);

//public
Route::post('/saveGeneralView',[GeneralStatsController::class,'newGeneralView'])->middleware('throttle:viewstat_rl');
Route::post('/saveInteraction',[GeneralStatsController::class,'newInteraction'])->middleware('throttle:interaction_rl');

//RL?
Route::post('/saveContactInfo',[ContactFormController::class,'store']);
