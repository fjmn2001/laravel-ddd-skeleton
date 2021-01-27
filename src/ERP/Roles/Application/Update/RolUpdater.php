<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolStatus;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;

final class RolUpdater
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolUpdaterRequest $request)
    {
        $rol = $this->repository->find(new RolId($request->id()));

        if (null === $rol) {
            throw new RolNotExistsException($request->id());
        }

        $rol->changeName(new RolName($request->name()));
        $rol->changeDescription(new RolDescription($request->description()));
        $rol->changeSuperuser(new RolSuperuser($request->superuser()));
        $rol->changeStatus(new RolStatus($request->status()));

        $this->repository->update($rol);
    }
}
