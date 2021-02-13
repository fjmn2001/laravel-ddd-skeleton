<?php


namespace Medine\ERP\Provider\Infrastructure;


use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ProviderRepositoy;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderCreatedAt;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderUpdatedAt;

class ProviderRepository implements ProviderRepositoy
{
    public function save(Provider $provider): void
    {

    }

    public function find(ProviderId $id): ?Provider
    {
        return (new Provider($id , new ProviderName('NAME'), new ProviderCreatedAt(),new ProviderUpdatedAt()));
    }

    public function update(Provider $provider): void
    {

    }
}
