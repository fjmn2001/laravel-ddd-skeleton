<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\ClientTypes\Application\Find\ClientTypeFinder;
use Medine\ERP\ClientTypes\Application\Find\ClientTypeFinderRequest;

final class ClientTypeGetController extends Controller
{
    private $finder;

    public function __construct(
        ClientTypeFinder $finder
    )
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id): JsonResponse
    {
        $response = ($this->finder)(new ClientTypeFinderRequest($id));

        return response()->json([
            'id' => $response->id(),
            'companyId' => $response->companyId(),
            'name' => $response->name(),
            'description' => $response->discription(),
            'state' => $response->state()
        ], JsonResponse::HTTP_OK);
    }
}
