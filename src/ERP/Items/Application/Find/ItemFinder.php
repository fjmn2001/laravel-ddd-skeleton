<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Find;

use Medine\ERP\Items\Application\Response\ItemResponse;
use Medine\ERP\Items\Domain\Service\Find\ItemFinder as Finder;

final class ItemFinder
{
    private $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ItemFinderRequest $request): ItemResponse
    {
        $category = ($this->finder)($request->id());

        return new ItemResponse(
            $category->id(),
            $category->name(),
            $category->description(),
            $category->state(),
            $category->companyId()
        );
    }
}
