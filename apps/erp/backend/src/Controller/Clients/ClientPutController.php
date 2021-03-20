<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Clients\Application\Updater\ClientUpdater;
use Medine\ERP\Clients\Application\Updater\ClientUpdaterRequest;

final class ClientPutController
{
    private $updater;

    public function __construct(
        ClientUpdater $updater
    )
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->updater)(new ClientUpdaterRequest(
            $request->input('id'),
            $request->input('name'),
            $request->input('lastname'),
            $request->input('dni'),
            $request->input('dniType'),
            $request->input('clientType'),
            $request->input('clientCategory'),
            $request->input('frequentClientNumber', ''),
            $request->input('state'),
            $request->input('phones'),
            $request->input('emails'),
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
