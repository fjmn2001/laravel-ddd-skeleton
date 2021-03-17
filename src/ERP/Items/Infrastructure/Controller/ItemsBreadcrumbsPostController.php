<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Items\Application\Find\ItemFinder;
use Medine\ERP\Items\Application\Find\ItemFinderRequest;

final class ItemsBreadcrumbsPostController
{
    private $finder;

    public function __construct(ItemFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(Request $request)
    {
        $name = str_replace('.', '_', $request->name);

        if (method_exists($this, $name)) {
            $response = call_user_func_array([$this, $name], array_filter([$request->params]));
            return new JsonResponse($response, JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'title' => '',
            'routes' => [],
            'menu' => []
        ], JsonResponse::HTTP_OK);
    }

    private function items(): array
    {
        return [
            'title' => 'Items',
            'routes' => [
                ['title' => 'Items', 'name' => 'items']
            ],
            'menu' => [
                'name' => 'items.create',
                'title' => 'Create',
                'options' => [
                    ['id' => 'export', 'title' => 'Export']
                ]
            ]
        ];
    }

    private function items_create(): array
    {
        return [
            'title' => 'Create item',
            'routes' => [
                ['title' => 'Items', 'name' => 'items'],
                ['title' => 'Create', 'name' => 'items.create'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Help']
                ]
            ]
        ];
    }

    private function items_edit(array $params): array
    {
        $item = ($this->finder)(new ItemFinderRequest($params['id']));
        return [
            'title' => 'Edit item',
            'routes' => [
                ['title' => 'Items', 'name' => 'items'],
                ['title' => $item->name(), 'name' => 'items.edit'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Help']
                ]
            ]
        ];
    }
}
