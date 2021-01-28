<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolCreatedAt;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolStatus;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;
use Medine\ERP\Roles\Domain\ValueObjects\RolUpdatedAt;
use Medine\ERP\Shared\Domain\Criteria;

final class MySqlRolRepository implements RolRepository
{

    public function save(Rol $rol): void
    {
        DB::table('roles')->insert([
            'id' => $rol->id()->value(),
            'name' => $rol->name()->value(),
            'description' => $rol->description()->value(),
            'superuser' => $rol->superuser()->value(),
            'company_id' => $rol->companyId()->value(),
            'created_at' => $rol->createdAt()->value(),
            'updated_at' => $rol->updatedAt()->value(),
        ]);
    }

    public function update(Rol $rol): void
    {
        DB::table('roles')->where('roles.id', $rol->id()->value())->take(1)->update([
            'name' => $rol->name()->value(),
            'description' => $rol->description()->value(),
            'superuser' => $rol->superuser()->value(),
            'status' => $rol->status()->value(),
            'updated_at' => $rol->updatedAt()->value(),
        ]);
    }

    public function find(RolId $id): ?Rol
    {
        $row = DB::table('roles')->where('roles.id', $id->value())->first();

        return !empty($row) ? Rol::fromDatabase(
            new RolId($row->id),
            new RolName($row->name),
            new RolDescription($row->description),
            new RolSuperuser($row->superuser),
            new RolStatus($row->status),
            new RolCompanyId($row->company_id),
            new RolCreatedAt($row->created_at),
            new RolUpdatedAt($row->updated_at),
        ) : null;
    }

    public function matching(Criteria $criteria): array
    {
        $query = DB::table('roles');

        $query = (new MySqlRolFilters($query))($criteria);

        if ($criteria->limit()) {
            $query->take($criteria->limit());
        }

        if ($criteria->offset()) {
            $query->skip($criteria->offset());
        }

        if ($criteria->order()->orderBy()->value()) {
            $query->orderBy($criteria->order()->orderBy()->value(), $criteria->order()->orderType()->value());
        }

        return $query->get()->map(function ($row) {
            return Rol::fromDatabase(
                new RolId($row->id),
                new RolName($row->name),
                new RolDescription($row->description),
                new RolSuperuser($row->superuser),
                new RolStatus($row->status),
                new RolCompanyId($row->company_id),
                new RolCreatedAt($row->created_at),
                new RolUpdatedAt($row->updated_at),
            );
        })->toArray();
    }
}
