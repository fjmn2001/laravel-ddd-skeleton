<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientCategories\Application\Response\ClientCategoryResponse;
use Medine\ERP\ClientCategories\Application\Search\ClientCategorySearcher;
use Medine\ERP\ClientCategories\Application\Search\ClientCategorySearcherRequest;
use function Lambdish\Phunctional\map;

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

        return new JsonResponse(map(function (ClientCategoryResponse $client) {
            return [
                'id' => $client->id(),
                'name' => $client->name(),
                'description' => $client->discription(),
                'state' => $client->stateButton(),
            ];
        }, $response->clientCategory()), JsonResponse::HTTP_OK);
    }
}
