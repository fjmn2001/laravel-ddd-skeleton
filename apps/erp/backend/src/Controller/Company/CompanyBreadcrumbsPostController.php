<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CompanyBreadcrumbsPostController extends Controller
{
    /**
     * @method void home()
     */
    public function __invoke(Request $request)
    {
        $name = str_replace('.', '_', $request->name);

        if (method_exists($this, $name)) {
            $response = call_user_func_array([$this, $name], array_filter([]));
            return new JsonResponse($response, JsonResponse::HTTP_OK);
        }

        return new JsonResponse([
            'title' => '',
            'routes' => [],
            'menu' => []
        ], JsonResponse::HTTP_OK);

    }

    private function companies(): array
    {
        return [
            'title' => 'Empresas',
            'routes' => [
                ['title' => 'Empresas', 'name' => 'companies']
            ],
            'menu' => [
                'name' => 'companies.create',
                'title' => 'Crear',
                'options' => [
                    ['id' => 'export', 'title' => 'Exportar']
                ]
            ]
        ];
    }

    private function companies_create(): array
    {
        return [
            'title' => 'Crear empresa',
            'routes' => [
                ['title' => 'Empresas', 'name' => 'companies'],
                ['title' => 'Crear', 'name' => 'companies.create'],
            ],
            'menu' => [
                'options' => [
                    ['id' => 'help', 'title' => 'Ayuda']
                ]
            ]
        ];
    }
}
