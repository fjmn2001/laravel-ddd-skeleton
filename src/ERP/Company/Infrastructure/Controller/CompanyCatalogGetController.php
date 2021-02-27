<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure\Controller;

use Illuminate\Http\Request;
use Medine\ERP\Company\Application\Response\CompanyCatalogsResponse;
use Medine\ERP\Shared\Application\Response\CatalogResponse;
use Medine\ERP\Shared\Application\Search\CatalogSearcher;
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
        ), new CompanyCatalogsResponse);

        return new \Illuminate\Http\JsonResponse([
            'states' => map(function (CatalogResponse $catalogResponse) {
                return ['id' => $catalogResponse->tag(), 'title' => $catalogResponse->value()];
            }, $response->states()),
        ], \Illuminate\Http\JsonResponse::HTTP_OK);
    }
}
