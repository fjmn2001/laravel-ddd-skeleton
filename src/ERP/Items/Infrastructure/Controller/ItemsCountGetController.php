<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Medine\ERP\Items\Application\Search\ItemCountSearcher;
use Medine\ERP\Items\Application\Search\ItemSearcherRequest;

final class ItemsCountGetController
{
    private $searcher;

    public function __construct(ItemCountSearcher $searcher)
    {
        $this->searcher = $searcher;
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

        return new JsonResponse($response->count(), JsonResponse::HTTP_OK);
    }

    private function stateButton(string $state): string
    {
        $title = Str::ucfirst($state);
        $class = $state === 'active' ? 'btn-green' : 'btn-red';

        return '<button type="button" class="btn btn-sm btn-table changeState ' . $class . '">' . $title . '</button>';
    }
}
