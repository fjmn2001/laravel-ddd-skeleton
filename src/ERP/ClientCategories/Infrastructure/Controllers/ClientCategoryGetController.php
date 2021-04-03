<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\ClientCategories\Application\Find\ClientCategoryFinder;
use Medine\ERP\ClientCategories\Application\Find\ClientCategoryFinderRequest;

final class ClientCategoryGetController extends Controller
{
    private $finder;

    public function __construct(
        ClientCategoryFinder $finder
    )
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id): JsonResponse
    {
        $response = ($this->finder)(new ClientCategoryFinderRequest($id));
        return  response()->json([
            'id' => $response->id(),
            'companyId' => $response->companyId(),
            'name' => $response->name(),
            'description' => $response->discription(),
            'state' => $response->state(),
        ], JsonResponse::HTTP_OK);
    }
}
