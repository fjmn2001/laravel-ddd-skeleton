<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Shared\Domain\Criteria;

interface RolRepository
{
    public function save(Rol $rol): void;

    public function find(RolId $id): ?Rol;

    public function update(Rol $rol): void;

    public function matching(Criteria $criteria);
}
