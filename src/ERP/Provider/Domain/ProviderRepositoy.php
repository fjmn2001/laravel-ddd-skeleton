<?php


namespace Medine\ERP\Provider\Domain;


use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;

interface ProviderRepositoy
{
    public function save(Provider $provider): void;
    public function find(ProviderId $id): ?Provider;
    public function update(Provider $provider): void;
}
