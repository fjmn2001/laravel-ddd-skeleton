<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Update;

use Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository;
use Medine\ERP\ItemCategories\Domain\Service\Find\ItemCategoryFinder;

final class ItemCategoryStateUpdater
{
    private $repository;

    public function __construct(ItemCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemCategoryFinder($repository);
    }

    public function __invoke(ItemCategoryStateUpdaterRequest $request)
    {
        $category = ($this->finder)($request->id());
        $category->changeState($request->state());
        $category->changeUpdatedBy($request->updatedBy());

        $this->repository->update($category);
    }
}
