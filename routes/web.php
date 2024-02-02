<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralStatsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::controller(ProjectController::class)
->group(function(){

    Route::middleware('auth')->group(function(){

        Route::get('/dashboard',DashboardController::class)->name('dashboard.index');
        
        Route::get('/proyectos','index')->name('proyectos.index');

        Route::get('/proyectos/crear','create')->name('proyectos.create');
        Route::post('/proyectos','store')->name('proyectos.store');

        Route::get('/proyectos/{project}/edit','edit')->name('proyectos.edit');
        Route::put('/proyectos/{project}','update')->name('proyectos.update'); //se puede usar post tranquilamente
        Route::delete('/proyectos/{project}','destroy')->name('proyectos.destroy');
    
    });
            
    Route::get('/proyectos/{project}','show')->name('proyectos.show');
               
});

Route::controller(LoginController::class)->group(function(){

    Route::get('/xlr8', 'showLoginForm')->name('login')->middleware('guest');
    Route::post('/xlr8', 'login');

});

Route::controller(GeneralStatsController::class)->group(function(){

    Route::post('/clickHandler','newInteraction')->name('interaction.handler');

});

Route::post('/send-contact-form',[ContactFormController::class,'store'])->name('contact.send');

Route::get('/{section?}', HomeController::class)->name('index');