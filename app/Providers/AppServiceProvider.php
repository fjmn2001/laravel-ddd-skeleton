<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Medine\ERP\Roles\Domain\MySqlRolRepository;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Medine\ERP\Shared\Domain\Bus\Event\EventBus;
use Medine\ERP\Shared\Domain\Bus\Event\SendEmailNotificationOnPasswordResetCreated;
use Medine\ERP\Shared\Infrastructure\Bus\Event\InMemory\InMemorySymfonyEventBus;
use Medine\ERP\Users\Domain\PasswordResetRepository;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Infrastructure\MySqlPasswordResetRepository;
use Medine\ERP\Users\Infrastructure\MySqlUserRepository;

use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Infrastructure\MySqlCompanyRepository;

use Medine\ERP\Company\Domain\CompanyHasUserRepository;
use Medine\ERP\Company\Infrastructure\MySqlCompanyHasUserRepository;

use function Lambdish\Phunctional\each;

class AppServiceProvider extends ServiceProvider
{
    private $wiringObjects = [
        UserRepository::class => MySqlUserRepository::class,
        CompanyRepository::class => MySqlCompanyRepository::class,
        CompanyHasUserRepository::class => MySqlCompanyHasUserRepository::class,
        RolRepository::class => MySqlRolRepository::class,
        PasswordResetRepository::class => MySqlPasswordResetRepository::class,
        //shared
        EventBus::class => InMemorySymfonyEventBus::class
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
