<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Items\Application\Find\ItemFinder;
use Medine\ERP\Items\Application\Find\ItemFinderRequest;

final class ItemGetController
{
    private $finder;

    public function __construct(ItemFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $response = ($this->finder)(new ItemFinderRequest($id));

        return new JsonResponse([
            'id' => $response->id(),
            'name' => $response->name(),
            'description' => $response->description(),
            'state' => $response->state(),
            'companyId' => $response->companyId()
        ], JsonResponse::HTTP_OK);
    }
}
