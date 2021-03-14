<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Medine\ERP\Clients\Application\Find\ClientFinder;
use Medine\ERP\Clients\Application\Find\ClientFinderRequest;

final class ClientGetController extends Controller
{
    private $finder;

    public function __construct(ClientFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $client = ($this->finder)(new ClientFinderRequest($id));

        return new JsonResponse([
            'id' => $client->id(),
            'name' => $client->name(),
            'lastname' => $client->lastname(),
            'dni' => $client->dni(),
            'dniType' => $client->dniType(),
            'clientType' => $client->clientType(),
            'clientCategory' => $client->clientCategory(),
            'frequentClientNumber' => $client->frequentClientNumber(),
            'state' => $client->state(),
            'phones' => $client->phones(),
            'emails' => $client->emails()
        ]);
    }
}
