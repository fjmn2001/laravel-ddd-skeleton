<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Application\Update;

use Medine\ERP\Item\Domain\Contracts\ItemRepository;
use Medine\ERP\Item\Domain\Service\ItemFinder;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemDescription;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;

final class ItemUpdater
{
    private $repository;
    private $finder;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemFinder($repository);
    }

    public function __invoke(UpdateItemRequest $request)
    {
        $item = ($this->finder)(new ItemId(
            $request->id()
        ));

        $item->changeCode(new ItemCode($request->code()));
        $item->changeName(new ItemName($request->name()));
        $item->changeReference($request->reference());
        $item->changeType(new ItemType($request->type()));
        $item->changeCategoryId(new ItemCategoryId($request->categoryId()));
        $item->changeState(new ItemState($request->state()));
        $item->changeUpdatedBy($request->updatedBy());

        $this->repository->update($item);
    }
}
