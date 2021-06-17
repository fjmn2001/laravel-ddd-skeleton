<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlLocationRepository extends MySqlRepository implements LocationRepository
{

    public function save(Location $location): void
    {
        DB::table('locations')->insert([
            'id' => $location->id()->value(),
            'code' => $location->code()->value(),
            'name' => $location->name()->value(),
            'main_contact' => $location->mainContact()->value(),
            'barcode' => $location->barcode()->value(),
            'address' => $location->address()->value(),
            'item_State' => $location->itemState()->value(),
            'state' => $location->state()->value(),
            'company_id' => $location->companyId()->value(),
            'created_by' => $location->createdBy(),
            'updated_by' => $location->updatedBy(),
            'created_at' => $location->createdAt()->value(),
            'updated_at' => $location->updatedAt()->value(),
        ]);
    }

    public function update(Location $location): void
    {
        DB::table('locations')->where('id', $location->id()->value())->update([
            'code' => $location->code()->value(),
            'name' => $location->name()->value(),
            'main_contact' => $location->mainContact()->value(),
            'barcode' => $location->barcode()->value(),
            'address' => $location->address()->value(),
            'item_State' => $location->itemState()->value(),
            'state' => $location->state()->value(),
            'updated_by' => $location->updatedBy(),
            'updated_at' => $location->updatedAt()->value(),
        ]);
    }

    public function find(LocationId $id): ?Location
    {
        return DB::table('locations')->where('locations.id', $id->value())
            ->limit(1)
            ->get()
            ->map($this->buildLocation())
            ->first();
    }

    private function buildLocation(): \Closure
    {
        return function ($location) {
            return Location::fromValue(
                $location->id,
                $location->code,
                $location->name,
                $location->main_contact,
                $location->barcode,
                $location->address,
                $location->item_state,
                $location->state,
                $location->company_id,
                $location->created_by,
                $location->updated_by,
                $location->created_at,
                $location->updated_at,
            );
        };
    }

    public function matching(Criteria $criteria): array
    {
        $query = DB::table('locations');
        $query = (new MySqlLocationFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildLocation())->toArray();
    }

    public function count(Criteria $criteria): int
    {
        $query = DB::table('locations');
        $query = (new MySqlLocationFilters($query))($criteria);

        return $query->count();
    }
}
