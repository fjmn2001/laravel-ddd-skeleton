<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Infrastructure\Persistence;


use Illuminate\Support\Facades\DB;
use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Entity\ClientCategory;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;

final class MysqlClientCategoryRepository implements ClientCategoryRepository
{

    public function find(ClientCategoryId $id): ?ClientCategory
    {
        // TODO: Implement find() method.
    }

    public function save(ClientCategory $clientCategory): void
    {
        DB::table('client_category')->insert([
            'id' => $clientCategory->id()->value(),
            'company_id' => $clientCategory->CompanyId()->value(),
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
        // TODO: Implement matching() method.
    }
}
