<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Infrastructure\Controller\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Item\Application\Create\CreateItemRequest;
use Medine\ERP\Item\Application\Create\ItemCreator;

final class ItemPostController extends Controller
{
    private $creator;

    public function __construct(ItemCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new CreateItemRequest(
            $request->id,
            $request->code,
            $request->name,
            $request->reference,
            $request->type,
            $request->categoryId,
            $request->state,
            $request->companyId,
            $request->user()->id
        ));

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
