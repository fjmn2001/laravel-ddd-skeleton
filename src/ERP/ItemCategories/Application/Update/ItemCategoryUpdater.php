<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Update;

use Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository;
use Medine\ERP\ItemCategories\Domain\Service\Find\ItemCategoryFinder;

final class ItemCategoryUpdater
{
    private $repository;

    public function __construct(ItemCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemCategoryFinder($repository);
    }

    public function __invoke(ItemCategoryUpdaterRequest $request)
    {
        $category = ($this->finder)($request->id());
        $category->changeName($request->name());
        $category->changeDescription($request->description());
        $category->changeState($request->state());
        $category->changeUpdatedBy($request->updatedBy());

        $this->repository->update($category);
    }
}
