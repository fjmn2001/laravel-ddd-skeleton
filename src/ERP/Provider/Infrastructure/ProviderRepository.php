<?php


namespace Medine\ERP\Provider\Infrastructure;


use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ProviderRepositoy;

class ProviderRepository implements ProviderRepositoy
{
    public function save(Provider $provider): void
    {

    }

    public function find(Provider $provider): ?Provider
    {
        return (new Provider('1', 'name'));
    }

    public function update(Provider $provider): void
    {

    }
}
