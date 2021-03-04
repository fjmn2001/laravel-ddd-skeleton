<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Service\Find;

final class ItemCategoryFinder
{
    private $repository;

    public function __construct(\Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new ItemCategoryNotExistsException($id);
        }

        return $category;
    }
}
