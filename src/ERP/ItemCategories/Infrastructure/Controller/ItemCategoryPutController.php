<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ItemCategories\Application\Update\ItemCategoryUpdater;
use Medine\ERP\ItemCategories\Application\Update\ItemCategoryUpdaterRequest;

final class ItemCategoryPutController
{
    private $updater;

    public function __construct(ItemCategoryUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new ItemCategoryUpdaterRequest(
            $id,
            $request->name,
            $request->description,
            $request->state,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
