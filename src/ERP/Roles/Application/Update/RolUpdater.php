<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

use Medine\ERP\Roles\Domain\RolRepository;

final class RolUpdater
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolUpdaterRequest $request)
    {
        $rol = $this->repository->find($request->id());

        if (null === $rol) {
            throw new RolNotExistsException($request->id());
        }

        if (false === ($rol->name() === $request->name())) {
            $rol->changeName($request->name());
            $rol->setUpdatedAt(new \DateTimeImmutable());
        }

        $this->repository->update($rol);
    }
}
