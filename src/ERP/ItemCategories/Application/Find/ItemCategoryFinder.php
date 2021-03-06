<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Find;

use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Domain\Service\Find\ItemCategoryFinder as Finder;

final class ItemCategoryFinder
{
    private $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ItemCategoryFinderRequest $request): ItemCategoryResponse
    {
        $category = ($this->finder)($request->id());

        return new ItemCategoryResponse(
            $category->id(),
            $category->name(),
            $category->description(),
            $category->state(),
            $category->companyId()
        );
    }
}
