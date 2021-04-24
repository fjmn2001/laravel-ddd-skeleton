<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\Request;
use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcher;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcherRequest;
use Medine\ERP\Items\Application\Response\ItemsCatalogsResponse;
use Medine\ERP\Locations\Application\Search\LocationCatalogSearcherResponse;
use Medine\ERP\Shared\Application\Response\CatalogResponse;
use Medine\ERP\Shared\Application\Search\CatalogSearcher;
use Medine\ERP\Shared\Application\Search\CatalogSearcherRequest;
use function Lambdish\Phunctional\map;

final class LocationsCatalogsGetController
{
    private $searcher;
    private $categorySearcher;

    public function __construct(CatalogSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(string $companyId, Request $request)
    {
        /** @var LocationCatalogSearcherResponse $response */
        $response = ($this->searcher)(new CatalogSearcherRequest(
            [
                ['field' => 'module', 'value' => 'items']
            ],
            'order',
            'asc'
        ), new LocationCatalogSearcherResponse);

        return new \Illuminate\Http\JsonResponse([
            'states' => map($this->buildCatalogResponse(), $response->states()),
            'itemStates' => map($this->buildCatalogResponse(), $response->itemStates())
        ], \Illuminate\Http\JsonResponse::HTTP_OK);
    }

    private function buildCatalogResponse(): \Closure
    {
        return function (CatalogResponse $catalogResponse) {
            return ['id' => $catalogResponse->tag(), 'title' => $catalogResponse->value()];
        };
    }
}
