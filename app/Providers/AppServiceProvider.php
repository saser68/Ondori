<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registrar servicios de la aplicación
     */
    public function register(): void
    {
        // Aquí irían los bindings del service container si los necesitamos
    }

    /**
     * Bootstrap de servicios
     * 
     * Se ejecuta después de que todos los servicios están registrados
     * TODO: Configurar paginación, model factories, etc.
     */
    public function boot(): void
    {
        // Configurar stuff aquí
    }
}
