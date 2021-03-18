<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Clients\Application\Response\ClientResponse;
use Medine\ERP\Clients\Application\Search\ClientSearcher;
use Medine\ERP\Clients\Application\Search\ClientSearcherRequest;
use function Lambdish\Phunctional\map;

final class ClientesGetController extends Controller
{
    private $searcher;

    public function __construct(ClientSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new ClientSearcherRequest(
            $request->get('filters', []),
            $request->order_by,
            $request->order,
            (int)$request->limit,
            (int)$request->offset
        ));


        return new JsonResponse(map(function (ClientResponse $client) {
            return [
                'id' => $client->id(),
                'name' => $client->name(),
                'phone' => $client->firstPhones(),
                'email' => $client->firstEmails(),
                'state' => $client->state(),
            ];
        }, $response->clients()), JsonResponse::HTTP_OK);
    }

}
