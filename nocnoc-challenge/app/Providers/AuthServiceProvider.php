<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Here is where you can register all of the routes for your application.
        // These are the policy definitions for the User model.
        Gate::define('view-user', 'App\Policies\UserPolicy@view');
        Gate::define('update-user', 'App\Policies\UserPolicy@update');
        Gate::define('delete-user', 'App\Policies\UserPolicy@delete');
        Gate::define('create-user', 'App\Policies\UserPolicy@create');
    }

    public function registerPolicies()
    {
        $this->app->singleton(PolicyResolver::class, function ($app) {
            return new PolicyResolver($app);
        });
    }
}