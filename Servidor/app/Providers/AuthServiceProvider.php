<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define("isResponsable", function ($user) {
            return $user->rol == "responsable";
        });
        Gate::define("isComercial", function ($user) {
            return $user->rol == "comercial";
        });
        Gate::define("isAdministrativo", function ($user) {
            return $user->rol == "administrativo";
        });
    }
}
