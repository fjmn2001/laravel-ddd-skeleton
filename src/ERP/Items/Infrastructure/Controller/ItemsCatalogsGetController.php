<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\Request;
use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcher;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcherRequest;
use Medine\ERP\Items\Application\Response\ItemsCatalogsResponse;
use Medine\ERP\Shared\Application\Response\CatalogResponse;
use Medine\ERP\Shared\Application\Search\CatalogSearcher;
use Medine\ERP\Shared\Application\Search\CatalogSearcherRequest;
use function Lambdish\Phunctional\map;

final class ItemsCatalogsGetController
{
    private $searcher;
    private $categorySearcher;

    public function __construct(
        CatalogSearcher $searcher,
        ItemCategorySearcher $categorySearcher
    )
    {
        $this->searcher = $searcher;
        $this->categorySearcher = $categorySearcher;
    }

    public function __invoke(string $companyId, Request $request)
    {
        $response = ($this->searcher)(new CatalogSearcherRequest(
            [
                ['field' => 'module', 'value' => 'items']
            ],
            'order',
            'asc'
        ), new ItemsCatalogsResponse);

        $categories = $this->categories($companyId);

        return new \Illuminate\Http\JsonResponse([
            'states' => map($this->buildCatalogResponse(), $response->states()),
            'categories' => $categories
        ], \Illuminate\Http\JsonResponse::HTTP_OK);
    }

    private function buildCatalogResponse(): \Closure
    {
        return function (CatalogResponse $catalogResponse) {
            return ['id' => $catalogResponse->tag(), 'title' => $catalogResponse->value()];
        };
    }

    private function categories(string $companyId): array
    {
        $response = ($this->categorySearcher)(new ItemCategorySearcherRequest([
            ['field' => 'companyId', 'value' => $companyId]
        ], 'name', 'asc', null, null));

        return map(function (ItemCategoryResponse $categoryResponse) {
            return ['id' => $categoryResponse->id(), 'title' => $categoryResponse->name()];
        }, $response->categories());
    }
}
