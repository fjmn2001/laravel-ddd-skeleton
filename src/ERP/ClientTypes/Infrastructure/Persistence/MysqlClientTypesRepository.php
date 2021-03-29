<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Infrastructure\Persistence;


use Illuminate\Support\Facades\DB;
use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Entity\ClientType;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;

final class MysqlClientTypesRepository implements ClientTypeRepository
{

    public function find(ClientTypeId $id): ?ClientType
    {
        // TODO: Implement find() method.
    }

    public function save(ClientType $clientType): void
    {
        DB::table('client_type')->insert([
            'id' => $clientType->id()->value(),
            'company_id' => $clientType->CompanyId()->value(),
            'name' => $clientType->name()->value(),
            'description' => $clientType->description()->value(),
            'state' => $clientType->state()->value(),
            'created_at' => $clientType->createdAt()->value(),
            'updated_at' => $clientType->updatedAt()->value(),
        ]);
    }

    public function update(ClientType $clientType): void
    {
        // TODO: Implement update() method.
    }

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array
    {
        // TODO: Implement matching() method.
    }
}
