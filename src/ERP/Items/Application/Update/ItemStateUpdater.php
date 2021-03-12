<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Update;

use Medine\ERP\Items\Domain\Entity\ItemRepository;
use Medine\ERP\Items\Domain\Service\Find\ItemFinder;

final class ItemStateUpdater
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemFinder($repository);
    }

    public function __invoke(ItemStateUpdaterRequest $request)
    {
        $category = ($this->finder)($request->id());
        $category->changeState($request->state());
        $category->changeUpdatedBy($request->updatedBy());

        $this->repository->update($category);
    }
}
