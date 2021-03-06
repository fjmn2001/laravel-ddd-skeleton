<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Clients\Application\Find\ClientFinder;
use Medine\ERP\Clients\Application\Find\ClientFinderRequest;

final class ClientBreadcrumbsPostController extends Controller
{
    private $finder;

    public function __construct(ClientFinder $finder)
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

    private function clients(): array
    {
        return [
            'title' => 'Clientes',
            'routes' => [
                ['title' => 'Clientes', 'name' => 'clients']
            ],
            'menu' => [
                'name' => 'clients.create',
                'title' => 'Crear',
                'options' => [
                    ['id' => 'export', 'title' => 'Exportar']
                ]
            ]
        ];
    }

    private function clients_create(): array
    {
        return [
            'title' => 'Crear cliente',
            'routes' => [
                ['title' => 'Clientes', 'name' => 'clients'],
                ['title' => 'Crear', 'name' => 'clients.create'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Ayuda']
                ]
            ]
        ];
    }

    private function clients_edit(array $params): array
    {
        $client = ($this->finder)(new ClientFinderRequest($params['id']));
        return [
            'title' => 'Editar cliente',
            'routes' => [
                ['title' => 'Clientes', 'name' => 'clients'],
                ['title' => $client->name(), 'name' => 'clients.edit'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Ayuda']
                ]
            ]
        ];
    }

}
