<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure\Controller\Product;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Product\Application\Update\ProductUpdater;
use Medine\ERP\Product\Application\Update\UpdateProductRequest;

final class ProductPutController
{
    private $updater;

    public function __construct(ProductUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new UpdateProductRequest(
            $id,
            $request->code,
            $request->name,
            $request->reference,
            $request->type,
            $request->categoryId,
            $request->state,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
