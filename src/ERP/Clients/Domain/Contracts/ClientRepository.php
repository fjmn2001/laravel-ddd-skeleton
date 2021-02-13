<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Domain\Contracts;

use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

interface ClientRepository
{
    public function find(ClientId $id): ?Client;
    public function save(Client $client): void;
    public function update(Client $company): void;
}
