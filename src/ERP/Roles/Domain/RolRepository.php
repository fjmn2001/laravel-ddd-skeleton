<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

interface RolRepository
{
    public function save(Rol $rol): void;

    public function find(string $id): ?Rol;

    public function update(Rol $rol): void;
}
