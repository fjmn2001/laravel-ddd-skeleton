<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientCategories\Application\Search\ClientCategorySearcher;
use Medine\ERP\ClientCategories\Application\Search\ClientCategorySearcherRequest;

final class ClientCategoriesGetController extends Controller
{
    private $searcher;

    public function __construct(
        ClientCategorySearcher $searcher
    )
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = ($this->searcher)(new ClientCategorySearcherRequest(
            $request->get('filters', []),
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
