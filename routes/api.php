<?php

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

Route::post('/saveContactInfo',[ContactFormController::class,'store']);
Route::post('/saveInteraction',[GeneralStatsController::class,'newInteraction']);
Route::post('/restartStat',[GeneralStatsController::class,'restartStat']);//->middleware('verificar.sesion');