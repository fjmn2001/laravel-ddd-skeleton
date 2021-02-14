<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure;

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
            'status' => $company->state()->value(),
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
            'status' => $company->state()->value(),
            'logo' => $company->logo()->value(),
            'updated_at' => $company->updatedAt()->value(),
        ]);
    }

    public function find(CompanyId $id): ?Company
    {
        $row = DB::table('companies')->where('companies.id', $id->value())->first();

        return !empty($row) ? Company::fromDatabase(
            new CompanyId($row->id),
            new CompanyName($row->name),
            new CompanyAddress($row->address),
            new CompanyState($row->status),
            new CompanyLogo($row->logo),
            new CompanyCreatedAt($row->created_at),
            new CompanyUpdatedAt($row->updated_at)
        ) : null;
    }

    public function matching(Criteria $criteria)
    {
        $query = DB::table('companies');
        //todo: $query = (new MySqlRolFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map(function ($row) {
            return Company::fromDatabase(
                new CompanyId($row->id),
                new CompanyName($row->name),
                new CompanyAddress($row->address),
                new CompanyState($row->status),
                new CompanyLogo($row->logo),
                new CompanyCreatedAt($row->created_at),
                new CompanyUpdatedAt($row->updated_at)
            );
        })->toArray();
    }
}
