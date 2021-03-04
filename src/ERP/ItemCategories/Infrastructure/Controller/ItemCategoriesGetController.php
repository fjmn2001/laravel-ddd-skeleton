<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Company\Application\Response\CompanyResponse;
use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcher;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcherRequest;
use function Lambdish\Phunctional\map;

final class ItemCategoriesGetController
{
    private $searcher;

    public function __construct(ItemCategorySearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new ItemCategorySearcherRequest(
            $request->filters,
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        return new JsonResponse(map(function (ItemCategoryResponse $category) {
            return [
                'id' => $category->id(),
                'name' => $category->name(),
                'description' => $category->description(),
                'state' => $category->state(),
                'companyId' => $category->companyId()
            ];
        }, $response->categories()), JsonResponse::HTTP_OK);
    }
}
