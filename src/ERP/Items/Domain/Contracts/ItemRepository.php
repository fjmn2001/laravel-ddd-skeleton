<?php

declare(strict_types=1);


namespace Medine\ERP\Items\Domain\Contracts;


use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Shared\Domain\Criteria;

interface ItemRepository
{
    public function save(Item $item): void;

    public function find(ItemId $itemId): ?Item;

    public function update(Item $item): void;

    public function count(Criteria $criteria): int;

    public function matching(Criteria $criteria): array;
}
