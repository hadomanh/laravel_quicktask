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
        $models = [
            'User',
            'Todo',
        ];
        foreach ($models as $model)
            app()->singleton(
                'App\Repositories\\' . $model . '\\' . $model . 'Repository',
                'App\Repositories\\' . $model . '\\' . $model . 'RepositoryImplement'
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
