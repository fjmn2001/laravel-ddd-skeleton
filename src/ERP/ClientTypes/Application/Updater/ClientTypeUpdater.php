<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Updater;

use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Service\ClientTypeFinder;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeDescription;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeName;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeState;

final class ClientTypeUpdater
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

    public function __invoke(ClientTypeUpdaterRequest $request)
    {
        $clientCategory =  ($this->finder)(new ClientTypeId($request->id()));

        $clientCategory->changeName(new ClientTypeName($request->name()));
        $clientCategory->changeDescription(new ClientTypeDescription($request->description()));
        $clientCategory->changeState(new ClientTypeState($request->state()));

        $this->repository->update($clientCategory);
    }
}
