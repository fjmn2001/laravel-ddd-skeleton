<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application;

use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperUser;

final class RolCreator
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolCreatorRequest $request)
    {
        $rol = Rol::create(
            new RolId($request->id()),
            new RolName($request->name()),
            new RolDescription($request->description()),
            new RolSuperUser($request->superuser()),
            new RolCompanyId($request->companyId())
        );
        $this->repository->save($rol);
    }
}
