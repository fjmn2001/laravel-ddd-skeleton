<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Application\Create;

use Medine\ERP\Item\Domain\Contracts\ItemRepository;
use Medine\ERP\Item\Domain\Entity\Item;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemDescription;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;

final class ItemCreator
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateItemRequest $request)
    {
        $item = Item::create(
            new ItemId($request->id()),
            new ItemCode($request->code()),
            new ItemName($request->name()),
            $request->reference(),
            new ItemType($request->type()),
            new ItemCategoryId($request->categoryId()),
            new ItemState($request->state()),
            $request->companyId(),
            $request->createdBy(),
        );

        $this->repository->save($item);
    }
}
