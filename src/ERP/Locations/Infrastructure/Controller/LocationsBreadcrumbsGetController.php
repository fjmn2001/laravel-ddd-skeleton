<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Find\LocationFinder;
use Medine\ERP\Locations\Application\Find\LocationFinderRequest;

final class LocationsBreadcrumbsGetController
{
    private $finder;

    public function __construct(LocationFinder $finder)
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

    private function locations(): array
    {
        return [
            'title' => 'Locations',
            'routes' => [
                ['title' => 'Locations', 'name' => 'locations']
            ],
            'menu' => [
                'name' => 'locations.create',
                'title' => 'Create',
                'options' => [
                    ['id' => 'export', 'title' => 'Export']
                ]
            ]
        ];
    }

    private function locations_create(): array
    {
        return [
            'title' => 'Create location',
            'routes' => [
                ['title' => 'locations', 'name' => 'locations'],
                ['title' => 'Create', 'name' => 'locations.create'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Help']
                ]
            ]
        ];
    }

    private function locations_edit(array $params): array
    {
        $item = ($this->finder)(new LocationFinderRequest($params['id']));
        return [
            'title' => 'Edit location',
            'routes' => [
                ['title' => 'locations', 'name' => 'locations'],
                ['title' => $item->name(), 'name' => 'locations.edit'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Help']
                ]
            ]
        ];
    }
}
