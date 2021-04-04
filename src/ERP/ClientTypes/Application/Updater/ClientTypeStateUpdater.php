<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Application\Updater;


use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Service\ClientCategoryFinder;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;
use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Service\ClientTypeFinder;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeState;

final class ClientTypeStateUpdater
{

    private $finder;
    private $repository;

    public function __construct(
        ClientTypeFinder $finder,
        ClientTypeRepository $repository
    )
    {
        $this->finder = $finder;
        $this->repository = $repository;
    }

    public function __invoke(ClientTypeStateUpdaterRequest $request)
    {
        $clientType = ($this->finder)(new ClientTypeId($request->id()));

        $clientType->changeState(new ClientTypeState($request->state()));

        $this->repository->update($clientType);
    }

}
