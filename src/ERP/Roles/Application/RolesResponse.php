<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application;

final class RolesResponse
{
    private $roles;

    public function __construct(RolResponse ...$roles)
    {
        $this->roles = $roles;
    }

    public function roles(): array
    {
        return $this->roles;
    }
}
