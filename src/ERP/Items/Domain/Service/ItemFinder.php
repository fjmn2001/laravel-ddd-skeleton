<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\Service;

use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;

final class ItemFinder
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemId $id): Item
    {
        $item = $this->repository->find($id);

        if (null === $item) {
            throw new ItemNotExistsException($id);
        }

        return $item;
    }
}
