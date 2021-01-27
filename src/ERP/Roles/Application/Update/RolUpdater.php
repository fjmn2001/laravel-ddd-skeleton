<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;

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

        if (false === ($rol->name()->value() === $request->name())) {
            $rol->changeName(new RolName($request->name()));
            $rol->setUpdatedAt(new \DateTimeImmutable());
        }

        $this->repository->update($rol);
    }
}
