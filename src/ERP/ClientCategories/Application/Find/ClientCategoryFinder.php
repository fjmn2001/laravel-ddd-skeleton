<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Application\Find;

use Medine\ERP\ClientCategories\Application\Response\ClientCategoryResponse;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;

final class ClientCategoryFinder
{
    private $finder;

    public function __construct(
        \Medine\ERP\ClientCategories\Domain\Service\ClientCategoryFinder $finder
    )
    {
        $this->finder = $finder;
    }

    public function __invoke(ClientCategoryFinderRequest $request): ClientCategoryResponse
    {
        $client =  ($this->finder)(new ClientCategoryId($request->id()));

        return new ClientCategoryResponse(
            $client->id()->value(),
            $client->companyId()->value(),
            $client->name()->value(),
            $client->description()->value(),
            $client->state()->value()
        );
    }
}
