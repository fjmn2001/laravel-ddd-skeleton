<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientTypes\Application\Updater\ClientTypeStateUpdater;
use Medine\ERP\ClientTypes\Application\Updater\ClientTypeStateUpdaterRequest;

final class ClientTypeStatePutController extends Controller
{
    private $stateUpdater;

    public function __construct(
        ClientTypeStateUpdater $stateUpdater
    )
    {
        $this->stateUpdater = $stateUpdater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->stateUpdater)(new ClientTypeStateUpdaterRequest(
            $id,
            $request->state
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
