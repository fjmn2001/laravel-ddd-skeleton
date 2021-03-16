<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Update;

use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Service\ItemFinder;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Items\Domain\ValueObjects\ItemState;

final class ItemStateUpdater
{
    private $repository;
    private $finder;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ItemFinder($repository);
    }

    public function __invoke(ItemStateUpdaterRequest $request)
    {
        $item = ($this->finder)(new ItemId(
            $request->id()
        ));

        $item->changeState(new ItemState($request->state()));
        $item->changeUpdatedBy($request->updatedBy());

        $this->repository->update($item);
    }
}
