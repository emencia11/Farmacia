<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];    

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('isRoot', function ($user) {
            return $user->rol === 'root'; // Asegúrate que el campo 'role' existe
        });

        Gate::define('canCreateUnidades', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });
        
        Gate::define('canEditUnidades', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });        
        
        Gate::define('canCreateCategorias', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });
        
        Gate::define('canEditCategorias', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });
        
        Gate::define('canCreateProveedores', function ($user) {
            return $user->rol === 'root';
        });
        
        Gate::define('canEditProveedores', function ($user) {
            return $user->rol === 'root';
        });

        // Permisos para Medicamentos
        Gate::define('canCreateMedicamentos', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });

        Gate::define('canEditMedicamentos', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });

        Gate::define('canDeleteMedicamentos', function ($user) {
            return $user->rol === 'root';  // Solo root puede eliminar
        });

        Gate::define('canCreateInventario', function ($user) {
            return true; // Cualquier rol puede crear
        });
        
        Gate::define('canEditInventario', function ($user) {
            return true; // Cualquier rol puede editar entradas/salidas manuales
        });
        
        Gate::define('canDeleteInventario', function ($user) {
            return $user->rol === 'root'; // Solo root puede eliminar
        });

        Gate::define('canCreateVentas', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });
        
        Gate::define('gestionar-devoluciones', function ($user) {
            return in_array($user->rol, ['root', 'vendedor']);
        });
    }
}
