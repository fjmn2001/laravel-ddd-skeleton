<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientCategories\Application\Updater\ClientCategoryStateUpdater;
use Medine\ERP\ClientCategories\Application\Updater\ClientCategoryStateUpdaterRequest;

final class ClientCategoryStatePutController extends Controller
{
    private $stateUpdater;

    public function __construct(
        ClientCategoryStateUpdater $stateUpdater
    )
    {
        $this->stateUpdater = $stateUpdater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->stateUpdater)(new ClientCategoryStateUpdaterRequest(
            $id,
            $request->state
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
