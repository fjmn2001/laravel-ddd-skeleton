<?php

declare(strict_types=1);

namespace Medine\ERP\Menu\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class LeftMenuGetController
{
    private $leftOptions = [
        'inventory' => [
            ['name' => 'items', 'title' => 'Items catalogs', 'class' => 'fa-fw icon-social-dropbox'],
            ['name' => 'locations', 'title' => 'Locations', 'class' => 'fa-fw icon-location-pin'],
            ['name' => 'inventory_settings', 'title' => 'Setting', 'class' => 'fa-fw icon-settings']
        ],
        'companies' => [
            ['name' => 'companies', 'title' => 'Companies', 'class' => 'fa fa-building-o fa-fw']
        ],
        'sales' => [
            ['name' => 'clients', 'title' => 'Clients', 'class' => 'fa-fw icon-people'],
            ['name' => 'sales_settings', 'title' => 'Setting', 'class' => 'fa-fw icon-settings']
        ],

    ];

    public function __invoke(Request $request)
    {
        $response = [];

        if (!empty($this->leftOptions[$request->name])) {
            $response = $this->leftOptions[$request->name];
        }

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
