<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Product;

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
            $request->category_id,
            $request->description,
            $request->type_id
        ));

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
