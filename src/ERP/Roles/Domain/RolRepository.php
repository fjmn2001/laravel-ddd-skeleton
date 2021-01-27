<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Medine\ERP\Roles\Domain\ValueObjects\RolId;

interface RolRepository
{
    public function save(Rol $rol): void;

    public function find(RolId $id): ?Rol;

    public function update(Rol $rol): void;
}
