<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Items\Application\Create\ItemCreatorRequest;
use Medine\ERP\Items\Application\Create\ItemCreator;

final class ItemPostController extends Controller
{
    private $creator;

    public function __construct(ItemCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new ItemCreatorRequest(
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
