<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Infrastructure\Persistence;


use Illuminate\Support\Facades\DB;
use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Entity\ClientCategory;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryCompanyId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryCreatedAt;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryDescription;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryName;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryUpdatedAt;
use Medine\ERP\Clients\Infrastructure\Repository\MySqlClientsFilters;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MysqlClientCategoryRepository extends MySqlRepository implements ClientCategoryRepository
{

    public function find(ClientCategoryId $id): ?ClientCategory
    {
        $object = DB::table('client_category')->find($id->value());

        return empty($object) ? null : ClientCategory::fromDatabase(
            new ClientCategoryId($object->id),
            new ClientCategoryCompanyId($object->company_id),
            new ClientCategoryName($object->name),
            new ClientCategoryDescription($object->description),
            new ClientCategoryState($object->state),
            new ClientCategoryCreatedAt($object->created_at),
            new ClientCategoryUpdatedAt($object->updated_at)
        );
    }

    public function save(ClientCategory $clientCategory): void
    {
        DB::table('client_category')->insert([
            'id' => $clientCategory->id()->value(),
            'company_id' => $clientCategory->companyId()->value(),
            'name' => $clientCategory->name()->value(),
            'description' => $clientCategory->description()->value(),
            'state' => $clientCategory->state()->value(),
            'created_at' => $clientCategory->createdAt()->value(),
            'updated_at' => $clientCategory->updatedAt()->value(),
        ]);
    }

    public function update(ClientCategory $client): void
    {
        // TODO: Implement update() method.
    }

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array
    {
        $query = DB::table('client_category');
        $query = (new MySqlClientCategoryFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);
        return $query->get()->map($this->buildClientCategorys())->toArray();
    }

    private function buildClientCategorys(): \Closure
    {
        return function ($row) {
            return ClientCategory::fromDatabase(
                new ClientCategoryId($row->id),
                new ClientCategoryCompanyId($row->company_id),
                new ClientCategoryName($row->name),
                new ClientCategoryDescription($row->description),
                new ClientCategoryState($row->state),
                new ClientCategoryCreatedAt($row->created_at),
                new ClientCategoryUpdatedAt($row->updated_at)
            );
        };
    }
}
