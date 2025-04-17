<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PocionsController;
use Illuminate\Support\Facades\Route;

//home
Route::controller(PocionsController::class)->group(function() {
    Route::match(['get', 'post'], '/', 'index');
    Route::match(['get', 'post'], '/My-Articles', 'privades')->name('mine');
});

//login
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});


//social login

//admin



//api


//contacte 


// materials

// QR


// recuperar contrasenya



//Per resource
Route::resource('/api', ApiController::class);
Route::apiResource('/api', ApiController::class);