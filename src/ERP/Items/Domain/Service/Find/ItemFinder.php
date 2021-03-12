<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\Service\Find;

final class ItemFinder
{
    private $repository;

    public function __construct(\Medine\ERP\Items\Domain\Entity\ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id)
    {
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new ItemNotExistsException($id);
        }

        return $category;
    }
}
