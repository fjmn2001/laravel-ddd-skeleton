<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Locations\Application\Find\LocationFinder;
use Medine\ERP\Locations\Application\Find\LocationFinderRequest;

final class LocationGetController
{
    private $finder;

    public function __construct(LocationFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $response = ($this->finder)(new LocationFinderRequest($id));

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
