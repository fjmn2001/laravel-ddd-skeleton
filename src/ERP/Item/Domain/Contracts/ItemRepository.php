<?php

declare(strict_types=1);


namespace Medine\ERP\Item\Domain\Contracts;


use Medine\ERP\Item\Domain\Entity\Item;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Shared\Domain\Criteria;

interface ItemRepository
{
    public function save(Item $item): void;

    public function find(ItemId $itemId): ?Item;

    public function update(Item $item): void;

    public function count(Criteria $criteria): int;
}
