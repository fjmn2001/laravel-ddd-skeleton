<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Domain\ValueObjects\CompanyAddress;
use Medine\ERP\Company\Domain\ValueObjects\CompanyCreatedAt;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Company\Domain\ValueObjects\CompanyLogo;
use Medine\ERP\Company\Domain\ValueObjects\CompanyName;
use Medine\ERP\Company\Domain\ValueObjects\CompanyState;
use Medine\ERP\Company\Domain\ValueObjects\CompanyUpdatedAt;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlCompanyRepository extends MySqlRepository implements CompanyRepository
{

    public function save(Company $company): void
    {
        DB::table('companies')->insert([
            'id' => $company->id()->value(),
            'name' => $company->name()->value(),
            'address' => $company->address()->value(),
            'state' => $company->state()->value(),
            'logo' => $company->logo()->value(),
            'created_at' => $company->createdAt()->value(),
            'updated_at' => $company->updatedAt()->value()
        ]);
    }

    public function update(Company $company): void
    {
        DB::table('companies')->where('companies.id', $company->id()->value())->take(1)->update([
            'name' => $company->name()->value(),
            'address' => $company->address()->value(),
            'state' => $company->state()->value(),
            'logo' => $company->logo()->value(),
            'updated_at' => $company->updatedAt()->value(),
        ]);
    }

    public function find(CompanyId $id): ?Company
    {
        $row = DB::table('companies')
            ->join('catalogs', function (JoinClause $join) {
                $join->on('catalogs.tag', '=', 'companies.state');
                $join->where('catalogs.type', '=', 'state');
                $join->where('catalogs.module', '=', 'companies');
            })
            ->where('companies.id', $id->value())
            ->select(['companies.id', 'name', 'address', 'state', 'logo', 'companies.created_at', 'companies.updated_at', 'users_quantity', DB::raw('catalogs.value as stateValue')])
            ->first();

        return !empty($row) ? Company::fromDatabase(
            new CompanyId($row->id),
            new CompanyName($row->name),
            new CompanyAddress($row->address),
            new CompanyState($row->state),
            new CompanyLogo($row->logo),
            new CompanyCreatedAt($row->created_at),
            new CompanyUpdatedAt($row->updated_at),
            $row->users_quantity,
            $row->stateValue
        ) : null;
    }

    public function matching(Criteria $criteria)
    {
        $query = DB::table('companies');
        $query = (new MySqlCompanyFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        $query->join('catalogs', function (JoinClause $join) {
            $join->on('catalogs.tag', '=', 'companies.state');
            $join->where('catalogs.type', '=', 'state');
            $join->where('catalogs.module', '=', 'companies');
        });
        $query->select(['companies.id', 'name', 'address', 'state', 'logo', 'companies.created_at', 'companies.updated_at', 'users_quantity', DB::raw('catalogs.value as stateValue')]);

        return $query->get()->map(function ($row) {
            return Company::fromDatabase(
                new CompanyId($row->id),
                new CompanyName($row->name),
                new CompanyAddress($row->address),
                new CompanyState($row->state),
                new CompanyLogo($row->logo),
                new CompanyCreatedAt($row->created_at),
                new CompanyUpdatedAt($row->updated_at),
                $row->users_quantity,
                $row->stateValue
            );
        })->toArray();
    }
}
