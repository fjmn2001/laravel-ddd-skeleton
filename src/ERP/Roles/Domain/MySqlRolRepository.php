<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Illuminate\Support\Facades\DB;

final class MySqlRolRepository implements RolRepository
{

    public function save(Rol $rol): void
    {
        DB::table('roles')->insert([
            'id' => $rol->id(),
            'name' => $rol->name(),
            'description' => $rol->description(),
            'superuser' => $rol->superuser(),
            'company_id' => $rol->companyId()
        ]);
    }
}
