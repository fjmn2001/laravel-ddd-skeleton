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

    public function save(ClientCategory $client): void
    {
        DB::table('client_category')->insert([
            'id' => $client->id()->value(),
            'name' => $client->name()->value(),
            'description' => $client->description()->value(),
            'state' => $client->state()->value(),
            'created_at' => $client->createdAt()->value(),
            'updated_at' => $client->updatedAt()->value(),
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
