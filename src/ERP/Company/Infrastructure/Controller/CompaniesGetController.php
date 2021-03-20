<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Company\Application\Response\CompanyResponse;
use Medine\ERP\Company\Application\Search\CompanySearcher;
use Medine\ERP\Company\Application\Search\CompanySearcherRequest;
use function Lambdish\Phunctional\map;

final class CompaniesGetController
{
    private $searcher;

    public function __construct(CompanySearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {

        $filters = $request->get('filters', []);

        $filters = is_array($filters) ? $filters : json_decode($filters);
        if (is_array($filters)) {
            $filters[] = ['field' => 'user', 'value' => $request->user()->id];
        }

        $response = ($this->searcher)(new CompanySearcherRequest(
            $filters,
            $request->get('order_by'),
            $request->get('order'),
            (int)$request->get('limit'),
            (int)$request->get('offset')
        ));

        return new JsonResponse(map(function (CompanyResponse $companyResponse) {
            return [
                'id' => $companyResponse->id(),
                'name' => $companyResponse->name(),
                'address' => $companyResponse->address(),
                'state' => $companyResponse->state(),
                'stateValue' => $companyResponse->stateValue(),
                'logo' => $companyResponse->logo(),
                'createdAt' => $companyResponse->createdAt(),
                'usersQuantity' => $companyResponse->usersQuantity()
            ];
        }, $response->companies()), JsonResponse::HTTP_OK);
    }
}
