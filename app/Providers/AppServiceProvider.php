<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Infrastructure\MySqlUserRepository;

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
        $this->app->bind(
            UserRepository::class,
            MySqlUserRepository::class
        );
    }
}
