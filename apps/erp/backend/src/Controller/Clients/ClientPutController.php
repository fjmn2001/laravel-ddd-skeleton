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
            $request->id,
            $request->name,
            $request->lastname,
            $request->dni,
            $request->dniType,
            $request->clientType,
            $request->clientCategory,
            $request->frequentClientNumber,
            $request->state,
            $request->phones,
            $request->emails,
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
