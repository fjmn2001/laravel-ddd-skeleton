<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class CompanyBreadcrumbsPostController extends Controller
{
    public function __invoke()
    {
        return new JsonResponse([
            'title' => 'Crear empresa',//todo: implement method for routes,
            'routes' => [
                ['title' => 'Empresas', 'name' => 'companies'],
                ['title' => 'Crear', 'name' => 'companies.create'],
            ],//todo: implement method for routes
            'menu' => [
            ]//todo: implement method for routes
        ], JsonResponse::HTTP_OK);
    }
}
