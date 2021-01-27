<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application;

use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;

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
            $request->id(),
            $request->name(),
            $request->description(),
            $request->superuser(),
            $request->companyId()
        );
        $this->repository->save($rol);
    }
}
