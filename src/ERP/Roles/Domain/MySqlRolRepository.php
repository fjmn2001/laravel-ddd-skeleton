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
            'company_id' => $rol->companyId(),
            'created_at' => $rol->createdAt(),
            'updated_at' => $rol->updatedAt(),
        ]);
    }

    public function update(Rol $rol): void
    {
        DB::table('roles')->where('roles.id', $rol->id())->take(1)->update([
            'name' => $rol->name(),
            'description' => $rol->description(),
            'superuser' => $rol->superuser(),
            'status' => $rol->status(),
            'updated_at' => $rol->updatedAt(),
        ]);
    }

    public function find(string $id): ?Rol
    {
        $row = DB::table('roles')->where('roles.id', $id)->first();

        return !empty($row) ? Rol::fromDatabase(
            $row->id,
            $row->name,
            $row->description,
            $row->superuser,
            $row->status,
            $row->company_id,
            new \DateTimeImmutable($row->created_at),
            new \DateTimeImmutable($row->updated_at),
        ) : null;
    }
}
