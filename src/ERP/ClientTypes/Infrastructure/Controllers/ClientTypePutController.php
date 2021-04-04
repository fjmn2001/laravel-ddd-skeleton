<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientTypes\Application\Updater\ClientTypeUpdater;
use Medine\ERP\ClientTypes\Application\Updater\ClientTypeUpdaterRequest;

final class ClientTypePutController extends Controller
{
    private $updater;

    public function __construct(
        ClientTypeUpdater $updater
    )
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->updater)(new ClientTypeUpdaterRequest(
            $id,
            $request->companyId,
            $request->name,
            !empty($request->description) ? $request->description : '',
            $request->state
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }

}
