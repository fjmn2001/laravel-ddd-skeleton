<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Infrastructure\MySqlUserRepository;

use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Infrastructure\MySqlCompanyRepository;
use function Lambdish\Phunctional\each;

class AppServiceProvider extends ServiceProvider
{
    private $wiringObjects = [
        UserRepository::class => MySqlUserRepository::class,
        CompanyRepository::class => MySqlCompanyRepository::class
    ];

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
        each(function ($concrete, $abstract) {
            $this->app->bind(
                $abstract,
                $concrete
            );
        }, $this->wiringObjects);
    }
}
