<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Medine\ERP\Roles\Domain\MySqlRolRepository;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Infrastructure\MySqlUserRepository;

use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Infrastructure\MySqlCompanyRepository;

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

        $this->app->bind(
            CompanyRepository::class,
            MySqlCompanyRepository::class
        );

        $this->app->bind(
            RolRepository::class,
            MySqlRolRepository::class
        );
    }
}
