<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Create;

use Medine\ERP\ItemCategories\Domain\Entity\ItemCategory;
use Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository;

final class ItemCategoryCreator
{
    private $repository;

    public function __construct(ItemCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemCategoryCreatorRequest $request)
    {
        $category = ItemCategory::create(
            $request->id(),
            $request->name(),
            $request->description(),
            $request->state(),
            $request->createdBy(),
            $request->companyId()
        );
        $this->repository->save($category);
    }
}
