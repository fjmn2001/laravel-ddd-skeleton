<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Locations\Application\Find\LocationFinder;
use Medine\ERP\Locations\Application\Find\LocationFinderRequest;
use Medine\ERP\Locations\Application\Find\LocationNotExists;

final class LocationGetController
{
    private $finder;

    public function __construct(LocationFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $response = ($this->finder)(new LocationFinderRequest($id));
        } catch (LocationNotExists $e) {
            return new JsonResponse([], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
