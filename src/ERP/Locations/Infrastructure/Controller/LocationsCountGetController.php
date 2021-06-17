<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Search\LocationCountSearcher;
use Medine\ERP\Locations\Application\Search\LocationCountSearcherRequest;

final class LocationsCountGetController
{
    private $searcher;

    public function __construct(LocationCountSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = ($this->searcher)(new LocationCountSearcherRequest(
            (array)$request->filters
        ));

        return new JsonResponse($response->count());
    }
}
