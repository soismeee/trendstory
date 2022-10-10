<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', function (User $user) {
            return $user->role == '1';
        });
        Gate::define('karyawan', function (User $user) {
            return $user->role == '2';
        });
        Gate::define('pelanggan', function (User $user) {
            return $user->role == '3';
        });
    }
}
