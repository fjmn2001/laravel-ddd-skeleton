<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain\Service;

use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;

final class RolFinder
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolId $id): Rol
    {
        $rol = $this->repository->find($id);

        if (null === $rol) {
            throw new RolNotExistsException($id);
        }

        return $rol;
    }
}
