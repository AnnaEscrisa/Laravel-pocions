<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $routeName = Route::currentRouteName(); 
    
            if (!$routeName && request()->path()) {
                $routeName = request()->path(); 
            }
    
            $titles = [
                'home' => 'Pocions',
                'mine' => 'Les meves Pocions',
                'login' => 'Login',
                'login.post' => 'Login',
                'register' => 'Registrar-se',
                'register.post' => 'Registrar-se',
                'insertar' => 'Nou Article',
                'editar' => 'Editar Article',
                'eliminar' => 'Eliminar Article',
                'clonar' => 'Clonar Article',
            ];
    
            $ruta = $titles[$routeName] ?? ucfirst(str_replace('-', ' ', basename($routeName)));
    
            $view->with('Ruta', $ruta);
        });
    }
}
