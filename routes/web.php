<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PocionsController;
use Illuminate\Support\Facades\Route;

//Pocions
Route::controller(PocionsController::class)->group(function() {
    Route::match(['get', 'post'], '/', 'index')->name('home');
    Route::match(['get', 'post'], '/My-Articles', 'privades')->name('mine')->middleware('auth');
    
    Route::prefix('/nou_article')->group(function() {
        Route::get('', 'formView')->name('insertar')->middleware('auth');
        Route::post('', 'insert')->name('insertar.post')->middleware('auth');
    });
    Route::prefix('/editar_article')->group(function() {
        Route::get('/{id}', 'formView')->name('editar')->middleware('auth');
        Route::post('/{id}', 'edit')->name('editar.post')->middleware('auth');
    });
    Route::prefix('/clonar_article')->group(function() {
        Route::get('/{id}', 'cloneView')->name('clonar')->middleware('auth');
        Route::post('/{id}', 'clone')->name('clonar.post')->middleware('auth');
    });
   
    Route::get('/eliminar_article/{id}', 'delete')->name('eliminar')->middleware('auth');
});

//login
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

//social login

//register
Route::controller(RegisterController::class)->group(function() {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'register')->name('register.post');
});

//admin



//api


//contacte 


// materials

// QR


// recuperar contrasenya



//Per resource
Route::resource('/api', ApiController::class);
Route::apiResource('/api', ApiController::class);