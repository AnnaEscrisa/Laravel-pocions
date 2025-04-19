<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PocionsController;
use Illuminate\Support\Facades\Route;

//home
Route::controller(PocionsController::class)->group(function() {
    Route::match(['get', 'post'], '/', 'index')->name('home');
    Route::match(['get', 'post'], '/My-Articles', 'privades')->name('mine')->middleware('auth');
    Route::match(['get', 'post'], '/nou-article', 'insert')->name('insertar')->middleware('auth');
    Route::match(['get', 'post'], '/editar-article/{id}', 'update')->name('editar')->middleware('auth');
    Route::match(['get', 'post'], '/eliminar-article/{id}', 'delete')->name('eliminar')->middleware('auth');
    Route::match(['get', 'post'], '/clonar-article/{id}', 'clone')->name('clonar')->middleware('auth');
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