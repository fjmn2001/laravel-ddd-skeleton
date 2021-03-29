<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Domain\Contracts;

use Medine\ERP\ClientTypes\Domain\Entity\ClientType;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;

interface ClientTypeRepository
{
    public function find(ClientTypeId $id): ?ClientType;
    public function save(ClientType $clientType): void;
    public function update(ClientType $client): void;
    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array;
}
