<?php


namespace Medine\ERP\Provider\Domain;


use Medine\ERP\Provider\Domain\Entity\Provider;

interface ProviderRepositoy
{
    public function save(Provider $provider): void;
    public function find(Provider $provider): ?Provider;
    public function update(Provider $provider): void;
}
