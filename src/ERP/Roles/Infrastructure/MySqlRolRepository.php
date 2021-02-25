<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Infrastructure;


use Illuminate\Support\Facades\DB;
use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolCreatedAt;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolState;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;
use Medine\ERP\Roles\Domain\ValueObjects\RolUpdatedAt;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlRolRepository extends MySqlRepository implements RolRepository
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
            'status' => $rol->state()->value(),
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
            new RolState($row->status),
            new RolCompanyId($row->company_id),
            new RolCreatedAt($row->created_at),
            new RolUpdatedAt($row->updated_at),
        ) : null;
    }

    public function matching(Criteria $criteria): array
    {
        $query = DB::table('roles');
        $query = (new MySqlRolFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map(function ($row) {
            return Rol::fromDatabase(
                new RolId($row->id),
                new RolName($row->name),
                new RolDescription($row->description),
                new RolSuperuser($row->superuser),
                new RolState($row->status),
                new RolCompanyId($row->company_id),
                new RolCreatedAt($row->created_at),
                new RolUpdatedAt($row->updated_at),
            );
        })->toArray();
    }
}
