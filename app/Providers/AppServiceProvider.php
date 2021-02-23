<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Infrastructure\MySqlLocationRepository;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Infrastructure\MySqlProductRepository;
use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Infrastructure\Repository\MySqlClientRepository;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceRepository;
use Medine\ERP\PurchaseInvoices\Infrastructure\Persistence\MySqlPurchaseInvoiceRepository;
use Medine\ERP\Roles\Infrastructure\MySqlRolRepository;
use Medine\ERP\Roles\Domain\RolRepository;
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
    private const TAGGED_SUBSCRIBERS = 'subscribers';

    private $wiringObjects = [
        UserRepository::class => MySqlUserRepository::class,
        CompanyRepository::class => MySqlCompanyRepository::class,
        CompanyHasUserRepository::class => MySqlCompanyHasUserRepository::class,
        RolRepository::class => MySqlRolRepository::class,
        PasswordResetRepository::class => MySqlPasswordResetRepository::class,
        PurchaseInvoiceRepository::class => MySqlPurchaseInvoiceRepository::class,
        LocationRepository::class => MySqlLocationRepository::class,
        ProductRepository::class => MySqlProductRepository::class,
        ClientRepository::class => MySqlClientRepository::class,
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

        $this->app->bind(EventBus::class, function () {
            $subscribers = [];
            each(function ($row) use (&$subscribers) {
                $subscribers[] = $row;
            }, $this->app->tagged(self::TAGGED_SUBSCRIBERS));
            return new InMemorySymfonyEventBus($subscribers);
        });

        $this->app->tag(
            [
                SendEmailNotificationOnPasswordResetCreated::class
            ],
            [self::TAGGED_SUBSCRIBERS]
        );
    }
}
