<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Roles\Infrastructure;

use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Shared\Domain\Criteria;
use function Lambdish\Phunctional\search;

final class InMemoryRolRepository implements RolRepository
{
    private $roles = [];

    public function save(Rol $rol): void
    {
        $this->roles[] = $rol;
    }

    public function find(RolId $id): ?Rol
    {
        return search(function (Rol $rol) use ($id) {
            return $rol->id()->equals($id);
        }, $this->roles);
    }

    public function update(Rol $rol): void
    {
        // TODO: Implement update() method.
    }

    public function matching(Criteria $criteria)
    {
        // TODO: Implement matching() method.
    }
}
