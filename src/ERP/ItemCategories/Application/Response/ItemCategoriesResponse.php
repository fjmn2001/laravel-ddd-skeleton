<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Response;

final class ItemCategoriesResponse
{
    private $categories;

    public function __construct(ItemCategoryResponse ...$categories)
    {
        $this->categories = $categories;
    }

    public function categories(): array
    {
        return $this->categories;
    }
}
