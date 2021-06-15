<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Search\LocationCatalogSearcherResponse;
use Medine\ERP\Shared\Application\Response\CatalogResponse;
use Medine\ERP\Shared\Application\Search\CatalogSearcher;
use Medine\ERP\Shared\Application\Search\CatalogSearcherRequest;
use function Lambdish\Phunctional\map;

final class LocationsCatalogsGetController
{
    private $searcher;

    public function __construct(CatalogSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var LocationCatalogSearcherResponse $response */
        $response = ($this->searcher)(new CatalogSearcherRequest(
            [
                ['field' => 'module', 'value' => 'locations']
            ],
            'order',
            'asc'
        ), new LocationCatalogSearcherResponse);

        return new JsonResponse([
            'states' => map($this->buildCatalogResponse(), $response->states()),
            'itemStates' => map($this->buildCatalogResponse(), $response->itemStates())
        ], JsonResponse::HTTP_OK);
    }

    private function buildCatalogResponse(): Closure
    {
        return static function (CatalogResponse $catalogResponse) {
            return ['id' => $catalogResponse->tag(), 'title' => $catalogResponse->value()];
        };
    }
}
