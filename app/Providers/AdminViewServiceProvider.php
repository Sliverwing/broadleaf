<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AdminViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        view()->composer('admin.*', function ($view) use ($auth) {
            $permissions = $auth->user()->getPermissionForNavBar();
            $view->with('permissions', $permissions);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
