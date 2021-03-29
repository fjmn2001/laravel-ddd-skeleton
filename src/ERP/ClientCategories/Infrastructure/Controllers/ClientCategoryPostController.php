<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ClientCategories\Application\Creator\ClientCategoryCreator;
use Medine\ERP\ClientCategories\Application\Creator\ClientCategoryCreatorRequest;

final class ClientCategoryPostController extends Controller
{
    private $creator;

    public function __construct(
        ClientCategoryCreator $creator
    )
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new ClientCategoryCreatorRequest(
            $request->id,
            $request->companyId,
            $request->name,
            $request->description,
            $request->state,
        ));

        return response()->json([], JsonResponse::HTTP_CREATED);
    }

}
