<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Search\LocationSearcher;
use Medine\ERP\Locations\Application\Search\LocationSearcherRequest;

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
            (int)$request->rows,
            (int)$request->page,
            (string)$request->sidx,
            (string)$request->sord
        ));

        return new JsonResponse([
            'rows' => $response->rows(),
            'page' => $response->page(),
            'total_pages' => $response->totalPages(),
            'records' => $response->records()
        ]);
    }
}
