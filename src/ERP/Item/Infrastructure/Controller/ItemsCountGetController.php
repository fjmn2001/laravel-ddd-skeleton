<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Item\Application\Search\ItemCountSearcher;
use Medine\ERP\Item\Application\Search\ItemCountSearcherRequest;

final class ItemsCountGetController
{
    private $searcher;

    public function __construct(ItemCountSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new ItemCountSearcherRequest(
            $request->filters,
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        return new JsonResponse($response->count(), JsonResponse::HTTP_OK);
    }
}
