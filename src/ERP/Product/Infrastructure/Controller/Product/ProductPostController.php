<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure\Controller\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;

final class ProductPostController extends Controller
{
    private $creator;

    public function __construct(ProductCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new CreateProductRequest(
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
