<?php

declare(strict_types=1);

namespace Medine\ERP\Menu\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TopMenuGetController
{
    public function __invoke(Request $request)
    {
        return new JsonResponse([
            ['name' => 'inventory', 'title' => 'Inventory'],
            ['name' => 'companies', 'title' => 'Companies'],
            ['name' => 'sales', 'title' => 'Sales'],
        ], JsonResponse::HTTP_OK);
    }
}
