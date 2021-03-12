<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Create;

use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\Entity\ItemRepository;

final class ItemCreator
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemCreatorRequest $request)
    {
        $category = Item::create(
            $request->id(),
            $request->name(),
            $request->reference(),
            $request->state(),
            $request->createdBy(),
            $request->companyId()
        );
        $this->repository->save($category);
    }
}
