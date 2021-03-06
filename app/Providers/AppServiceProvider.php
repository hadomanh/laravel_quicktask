<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton(
            'App\Repositories\User\User\Repository',
            'App\Repositories\User\User\RepositoryImplement'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
