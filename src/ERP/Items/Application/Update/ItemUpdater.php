<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Update;

use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Service\ItemFinder;
use Medine\ERP\Items\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Items\Domain\ValueObjects\ItemCode;
use Medine\ERP\Items\Domain\ValueObjects\ItemDescription;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Items\Domain\ValueObjects\ItemName;
use Medine\ERP\Items\Domain\ValueObjects\ItemState;
use Medine\ERP\Items\Domain\ValueObjects\ItemType;

final class ItemUpdater
{
    private $repository;
    private $finder;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemFinder($repository);
    }

    public function __invoke(ItemUpdaterRequest $request)
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
