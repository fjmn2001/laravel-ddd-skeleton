<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

use Medine\ERP\Shared\Application\Response\CatalogResponse;
use Medine\ERP\Shared\Domain\Catalog;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;

final class LocationCatalogSearcherResponse
{
    private $catalogs = [];

    public function __invoke(array $catalogs)
    {
        $this->catalogs = $catalogs;
    }

    public function states(): array
    {
        $filtered = filter(function (Catalog $catalog) {
            return $catalog->type()->value() === 'state';
        }, $this->catalogs);

        return map(function (Catalog $catalog) {
            return new CatalogResponse(
                $catalog->tag()->value(),
                $catalog->value()->value()
            );
        }, $filtered);
    }

    public function itemStates(): array
    {
        $filtered = filter(function (Catalog $catalog) {
            return $catalog->type()->value() === 'itemState';
        }, $this->catalogs);

        return map(function (Catalog $catalog) {
            return new CatalogResponse(
                $catalog->tag()->value(),
                $catalog->value()->value()
            );
        }, $filtered);
    }
}
