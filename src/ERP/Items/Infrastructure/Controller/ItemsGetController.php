<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcher;
use Medine\ERP\ItemCategories\Application\Search\ItemCategorySearcherRequest;
use Medine\ERP\Items\Application\Response\ItemResponse;
use Medine\ERP\Items\Application\Search\ItemSearcher;
use Medine\ERP\Items\Application\Search\ItemSearcherRequest;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\each;

final class ItemsGetController
{
    private $searcher;
    private $categorySearcher;
    private $categories = [];

    public function __construct(ItemSearcher $searcher, ItemCategorySearcher $categorySearcher)
    {
        $this->searcher = $searcher;
        $this->categorySearcher = $categorySearcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new ItemSearcherRequest(
            $request->filters,
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        $this->setCategories($request);

        return new JsonResponse(map(function (ItemResponse $item) {
            return [
                'id' => $item->id(),
                'code' => $item->code(),
                'name' => $item->name(),
                'reference' => $item->reference(),
                'type' => $item->type(),
                'categoryId' => $this->category($item->categoryId()),
                'state' => $this->stateButton($item->state()),
                'averageCost' => $this->averageCostTag($item->averageCost()),
                'companyId' => $item->companyId()
            ];
        }, $response->items()), JsonResponse::HTTP_OK);
    }

    private function stateButton(string $state): string
    {
        $title = Str::ucfirst($state);
        $class = $state === 'active' ? 'btn-green' : 'btn-red';

        return '<button type="button" class="btn btn-sm btn-table changeState ' . $class . '">' . $title . '</button>';
    }

    private function averageCostTag(float $averageCost)
    {
        return '<p class="borde-yellow1">$' . number_format($averageCost, 4) . '</p>';
    }

    private function buildFilter(): \Closure
    {
        return function ($filter) {
            return !empty($filter['field']) && $filter['field'] === 'companyId';
        };
    }

    private function category(string $categoryId)
    {
        return $this->categories[$categoryId] ?? '';
    }

    private function setCategories(Request $request): void
    {
        $categoriesReponse = ($this->categorySearcher)(new ItemCategorySearcherRequest(
            filter($this->buildFilter(), $request->filters), null, null, null, null
        ));
        each(function (ItemCategoryResponse $categoryResponse) {
            $this->categories[$categoryResponse->id()] = $categoryResponse->name();
        }, $categoriesReponse->categories());
    }
}
