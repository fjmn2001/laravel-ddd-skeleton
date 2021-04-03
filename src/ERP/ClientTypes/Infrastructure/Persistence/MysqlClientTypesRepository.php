<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Infrastructure\Persistence;


use Illuminate\Support\Facades\DB;
use Medine\ERP\Clients\Infrastructure\Repository\MySqlClientsFilters;
use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Entity\ClientType;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeCompanyId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeCreatedAt;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeDescription;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeName;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeState;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeUpdatedAt;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MysqlClientTypesRepository  extends MySqlRepository implements ClientTypeRepository
{

    public function find(ClientTypeId $id): ?ClientType
    {
        $object = DB::table('client_type')->find($id->value());

        return empty($object) ? null : ClientType::fromDatabase(
            new ClientTypeId($object->id),
            new ClientTypeCompanyId($object->company_id),
            new ClientTypeName($object->name),
            new ClientTypeDescription($object->description),
            new ClientTypeState($object->state),
            new ClientTypeCreatedAt($object->created_at),
            new ClientTypeUpdatedAt($object->updated_at)
        );
    }

    public function save(ClientType $clientType): void
    {
        DB::table('client_type')->insert([
            'id' => $clientType->id()->value(),
            'company_id' => $clientType->companyId()->value(),
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
        $query = DB::table('client_type');
        $query = (new MySqlClientTypesFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);
        return $query->get()->map($this->buildClientTypes())->toArray();
    }

    private function buildClientTypes(): \Closure
    {
        return function ($row) {
            return ClientType::fromDatabase(
                new ClientTypeId($row->id),
                new ClientTypeCompanyId($row->company_id),
                new ClientTypeName($row->name),
                new ClientTypeDescription($row->description),
                new ClientTypeState($row->state),
                new ClientTypeCreatedAt($row->created_at),
                new ClientTypeUpdatedAt($row->updated_at)
            );
        };
    }
}
