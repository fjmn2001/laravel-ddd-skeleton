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
        $response = ($this->searcher)(new CompanySearcherRequest(
            map(function (string $filter) {
                return json_decode($filter, true);
            }, $request->get('filters', [])),
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
                'logo' => $companyResponse->logo()
            ];
        }, $response->companies()), JsonResponse::HTTP_OK);
    }
}
