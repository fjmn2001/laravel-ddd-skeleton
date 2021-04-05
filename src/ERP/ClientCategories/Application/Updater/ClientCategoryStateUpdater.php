<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Application\Updater;


use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Service\ClientCategoryFinder;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;

final class ClientCategoryStateUpdater
{

    private $finder;
    private $repository;

    public function __construct(
        ClientCategoryFinder $finder,
        ClientCategoryRepository $repository
    )
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function __invoke(ClientCategoryStateUpdaterRequest $request)
    {
        $clientCategory = ($this->finder)(new ClientCategoryId($request->id()));

        $clientCategory->changeState(new ClientCategoryState($request->state()));

        $this->repository->update($clientCategory);
    }

}
