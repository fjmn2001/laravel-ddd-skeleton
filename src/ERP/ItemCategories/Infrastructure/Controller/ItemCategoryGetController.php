<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Medine\ERP\ItemCategories\Application\Find\ItemCategoryFinder;
use Medine\ERP\ItemCategories\Application\Find\ItemCategoryFinderRequest;

final class ItemCategoryGetController
{
    private $finder;

    public function __construct(ItemCategoryFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $response = ($this->finder)(new ItemCategoryFinderRequest($id));

        return new JsonResponse([
            'id' => $response->id(),
            'name' => $response->name(),
            'description' => $response->description(),
            'state' => $response->state(),
            'companyId' => $response->companyId()
        ], JsonResponse::HTTP_OK);
    }
}
