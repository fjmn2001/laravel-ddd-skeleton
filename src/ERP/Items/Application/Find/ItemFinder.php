<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Find;

use Medine\ERP\Items\Application\Response\ItemResponse;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Service\ItemFinder as DomainItemFinder;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;

final class ItemFinder
{
    private $finder;

    public function __construct(ItemRepository $repository)
    {
        $this->finder = new DomainItemFinder($repository);
    }

    public function __invoke(ItemFinderRequest $request): ItemResponse
    {
        $item = ($this->finder)(new ItemId($request->id()));

        return new ItemResponse(
            $item->id()->value(),
            $item->code()->value(),
            $item->name()->value(),
            $item->reference(),
            $item->type()->value(),
            $item->categoryId()->value(),
            $item->state()->value(),
            $item->averageCost(),
            $item->companyId()
        );
    }
}
