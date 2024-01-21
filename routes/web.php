<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('index');

Route::controller(ProjectController::class)->group(function(){

    Route::get('/proyectos','index')->name('proyectos.index');

    Route::get('/proyectos/crear','create')->name('proyectos.create');

    Route::get('/proyectos/{id}','show')->name('proyectos.show');

    Route::post('/proyectos','store')->name('proyectos.store');
    Route::get('/proyectos/{id}/edit','edit')->name('proyectos.edit');
    Route::put('/proyectos/{proyecto}','update')->name('proyectos.update'); //se puede usar post tranquilamente
    Route::delete('/proyectos/{proyecto}','destroy')->name('proyectos.destroy');
});
