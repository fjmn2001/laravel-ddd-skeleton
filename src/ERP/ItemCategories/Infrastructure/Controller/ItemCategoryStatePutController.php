<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ItemCategories\Application\Update\ItemCategoryStateUpdater;
use Medine\ERP\ItemCategories\Application\Update\ItemCategoryStateUpdaterRequest;

final class ItemCategoryStatePutController
{
    private $updater;

    public function __construct(ItemCategoryStateUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new ItemCategoryStateUpdaterRequest(
            $id,
            $request->state,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
