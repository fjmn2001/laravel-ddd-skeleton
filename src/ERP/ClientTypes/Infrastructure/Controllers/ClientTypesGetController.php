<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientTypes\Application\Response\ClientTypeResponse;
use Medine\ERP\ClientTypes\Application\Search\ClientTypeSearcher;
use Medine\ERP\ClientTypes\Application\Search\ClientTypeSearcherRequest;
use function Lambdish\Phunctional\map;

final class ClientTypesGetController extends Controller
{
    private $searcher;

    public function __construct(
        ClientTypeSearcher $searcher
    )
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $response = ($this->searcher)(new ClientTypeSearcherRequest(
            $request->get('filters', []),
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));

        return new JsonResponse(map(function (ClientTypeResponse $client) {
            return [
                'id' => $client->id(),
                'name' => $client->name(),
                'description' => $client->discription(),
                'state' => $client->stateButton(),
            ];
        }, $response->clientType()), JsonResponse::HTTP_OK);       }
}
