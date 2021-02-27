<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Company\Application\Response\CompanyResponse;
use Medine\ERP\Company\Application\Search\CompanySearcher;
use Medine\ERP\Company\Application\Search\CompanySearcherRequest;
use Medine\ERP\Shared\Application\Search\CatalogSearcher;
use Medine\ERP\Shared\Application\Search\SearcherRequest;
use Medine\ERP\Shared\Application\Search\CatalogSearcherRequest;
use function Lambdish\Phunctional\map;

final class CompanyCatalogGetController
{
    private $searcher;

    public function __construct(CatalogSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new CatalogSearcherRequest(
            [
                ['field' => 'module', 'value' => 'companies']
            ],
            'order',
            'asc'
        ));
        dd($response);
//
//        return new JsonResponse(map(function (CompanyResponse $companyResponse) {
//            return [
//                'id' => $companyResponse->id(),
//                'name' => $companyResponse->name(),
//                'address' => $companyResponse->address(),
//                'state' => $companyResponse->state(),
//                'logo' => $companyResponse->logo(),
//                'createdAt' => $companyResponse->createdAt(),
//                'usersQuantity' => $companyResponse->usersQuantity()
//            ];
//        }, $response->companies()), JsonResponse::HTTP_OK);
        //        return new \Illuminate\Http\JsonResponse([
//            'states' => [
//                ['id' => 'active', 'title' => 'Activa'],
//                ['id' => 'inactive', 'title' => 'Inactiva']
//            ]
//        ], \Illuminate\Http\JsonResponse::HTTP_OK);
    }
}
