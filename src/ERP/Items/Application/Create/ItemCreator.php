<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Create;

use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Items\Domain\ValueObjects\ItemCode;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Items\Domain\ValueObjects\ItemName;
use Medine\ERP\Items\Domain\ValueObjects\ItemState;
use Medine\ERP\Items\Domain\ValueObjects\ItemType;

final class ItemCreator
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemCreatorRequest $request)
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
