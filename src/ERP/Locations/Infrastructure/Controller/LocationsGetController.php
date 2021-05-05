<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Search\LocationSearcher;
use Medine\ERP\Locations\Application\Search\LocationSearcherRequest;
use Medine\ERP\Locations\Application\Search\LocationSearcherResponse;
use function Lambdish\Phunctional\map;

final class LocationsGetController
{
    private $searcher;

    public function __construct(LocationSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = ($this->searcher)(new LocationSearcherRequest(
            (array)$request->filters,
            $request->orderBy,
            $request->order,
            (int)$request->offset,
            (int)$request->limit
        ));

        return new JsonResponse(map(function (LocationSearcherResponse $searcherResponse) {
            return [
                'id' => $searcherResponse->id(),
                'code' => $searcherResponse->code(),
                'name' => $searcherResponse->name(),
                'mainContact' => $searcherResponse->mainContact(),
                'barcode' => $searcherResponse->barcode(),
                'address' => $searcherResponse->address(),
                'state' => $searcherResponse->state()
            ];
        }, $response->locations()));
    }
}
