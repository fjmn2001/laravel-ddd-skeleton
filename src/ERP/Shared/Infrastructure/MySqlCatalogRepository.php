<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Shared\Domain\Catalog;
use Medine\ERP\Shared\Domain\CatalogRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogId;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogModule;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogOrder;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogTag;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogType;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogValue;

final class MySqlCatalogRepository extends MySqlRepository implements CatalogRepository
{
    public function matching(Criteria $criteria)
    {
        $query = DB::table('catalogs');
        $query = (new MySqlCatalogFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map(function ($row) {
            return Catalog::fromDatabase(
                new CatalogId($row->id),
                new CatalogTag($row->tag),
                new CatalogValue($row->value),
                new CatalogType($row->type),
                new CatalogModule($row->module),
                new CatalogOrder($row->order)
            );
        })->toArray();
    }
}
