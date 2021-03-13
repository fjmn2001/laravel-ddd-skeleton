<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Product\Application\Search\ProductCountSearcher;
use Medine\ERP\Product\Application\Search\ProductCountSearcherRequest;

final class ProductsCountGetController
{
    private $searcher;

    public function __construct(ProductCountSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new ProductCountSearcherRequest(
            $request->filters,
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        return new JsonResponse($response->count(), JsonResponse::HTTP_OK);
    }
}
