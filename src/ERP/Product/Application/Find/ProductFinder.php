<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Find;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

//    public function __invoke(FindProductRequest $request): JsonResponse
//    {
//
//    }
}
