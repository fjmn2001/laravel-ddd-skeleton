<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\Service\RolFinder;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolStatus;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;

final class RolUpdater
{
    private $repository;
    private $finder;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new RolFinder($repository);
    }

    public function __invoke(RolUpdaterRequest $request)
    {
        $rol = ($this->finder)(new RolId($request->id()));

        $rol->changeName(new RolName($request->name()));
        $rol->changeDescription(new RolDescription($request->description()));
        $rol->changeSuperuser(new RolSuperuser($request->superuser()));
        $rol->changeStatus(new RolStatus($request->status()));

        $this->repository->update($rol);
    }
}
