<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\ItemCategories\Application\Create\ItemCategoryCreator;
use Medine\ERP\ItemCategories\Application\Create\ItemCategoryCreatorRequest;

final class ItemCategoryPostController
{
    private $creator;

    public function __construct(ItemCategoryCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        ($this->creator)(new ItemCategoryCreatorRequest(
            $request->id,
            $request->name,
            $request->description,
            $request->state,
            $request->user()->id,
            $request->companyId
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
