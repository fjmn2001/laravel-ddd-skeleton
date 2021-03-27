<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
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
                'state' => $this->stateButton($client->state()),
                'creditoFavor' => $this->creditoFavorTag(0),
                'saldoCobrar' => $this->saldoCobrar(0),
            ];
        }, $response->clients()), JsonResponse::HTTP_OK);
    }

    private function stateButton(string $state): string
    {
        $title = Str::ucfirst($state);
        $class = $state === 'active' ? 'btn-green' : 'btn-red';

        return '<button type="button" class="btn btn-sm btn-table changeState ' . $class . '">' . $title . '</button>';
    }

    private function creditoFavorTag(float $credito)
    {
        return '<p class="borde-green1">$' . number_format($credito, 4) . '</p>';
    }

    private function saldoCobrar(float $saldo)
    {
        return '<p class="borde-yellow1">$' . number_format($saldo, 4) . '</p>';
    }

}
