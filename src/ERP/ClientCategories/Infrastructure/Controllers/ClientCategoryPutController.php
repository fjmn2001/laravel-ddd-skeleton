<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientCategories\Application\Updater\ClientCategoryUpdater;
use Medine\ERP\ClientCategories\Application\Updater\ClientCategoryUpdaterRequest;

final class ClientCategoryPutController extends Controller
{
    private $updater;

    public function __construct(
        ClientCategoryUpdater $updater
    )
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->updater)(new ClientCategoryUpdaterRequest(
            $id,
            $request->companyId,
            $request->name,
            $request->description,
            $request->state
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }

}
