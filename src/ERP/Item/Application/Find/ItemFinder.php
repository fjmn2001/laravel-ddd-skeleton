<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Application\Find;

use Medine\ERP\Item\Domain\Contracts\ItemRepository;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;

final class ItemFinder
{
    private $repository;
    private $finder;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new \Medine\ERP\Item\Domain\Service\ItemFinder($repository);
    }

    public function __invoke(FindItemRequest $request): ItemResponse
    {
        $item = ($this->finder)(new ItemId($request->id()));

        return new ItemResponse(
            $item->id()->value(),
            $item->code()->value(),
            $item->name()->value(),
            $item->categoryId()->value(),
            $item->reference(),
            $item->type()->value(),
            $item->state()->value()
        );
    }
}
