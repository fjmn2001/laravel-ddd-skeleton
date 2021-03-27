<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Clients\Application\Updater\ClientStateUpdater;
use Medine\ERP\Clients\Application\Updater\ClientStateUpdaterRequest;

final class ClientStatePutController extends Controller
{
    private $updater;

    public function __construct(ClientStateUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new ClientStateUpdaterRequest(
            $request->id,
            $request->state,
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
