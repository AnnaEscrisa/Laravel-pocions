<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PocionsController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

//Pocions
Route::controller(PocionsController::class)->group(function () {
    Route::match(['get', 'post'], '/', 'index')->name('home');
    Route::match(['get', 'post'], '/My-Articles', 'privades')->name('mine')->middleware('auth');

    Route::prefix('/nou_article')->group(function () {
        Route::get('', 'formView')->name('insertar')->middleware('auth');
        Route::post('', 'insert')->name('insertar.post')->middleware('auth');
    });
    Route::prefix('/editar_article')->group(function () {
        Route::get('/{id}', 'formView')->name('editar')->middleware('auth');
        Route::post('/{id}', 'edit')->name('editar.post')->middleware('auth');
    });
    Route::prefix('/clonar_article')->group(function () {
        Route::get('/{id}', 'cloneView')->name('clonar')->middleware('auth');
        Route::post('/{id}', 'clone')->name('clonar.post')->middleware('auth');
    });

    Route::get('/eliminar_article/{id}', 'delete')->name('eliminar')->middleware('auth');
});

//login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

//social login
Route::controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/github', 'githubLogin')->name('github.login');
});

//register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'register')->name('register.post');
});

//perfil
Route::controller(UsersController::class)->group(function () {
    Route::prefix('/profile')->group(function () {
        Route::get('/edit', 'edit')->name('profile.edit')->middleware('auth');
        Route::post('/edit', 'update')->name('profile.edit.post')->middleware('auth');
        Route::get('', 'profile')->name('profile');
    });
});

//password
Route::controller(PasswordController::class)->group(function () {
    Route::get('/reset', 'recuperaView')->name('password.reset');
    Route::post('/reset', 'sendResetLink')->name('password.reset.post');
    Route::get('/new_pass/{token?}', 'canviView')->name('new_pass');
    Route::post('/new_pass/{token?}', 'canviPass')->name('password.reset.token.post');
});

// QR
Route::controller(QRController::class)->group(function () {
    Route::prefix('/qr')->group(function () {
        Route::get('/lector', 'index')->name('qr.lector');
        Route::post('/lector', 'lectura')->name('qr.lector.post');
        Route::post('/generar', 'articleQr')->name('qr.generar.post');
    });
});

//admin



//api


//contacte 


// materials




// recuperar contrasenya



//Per resource
Route::resource('/api', ApiController::class);
Route::apiResource('/api', ApiController::class);