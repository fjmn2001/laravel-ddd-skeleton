<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;

final class MySqlCompanyRepository implements CompanyRepository
{

    public function save(Company $company): void
    {
        DB::table('companies')->insert([
            'id' => $company->id(),
            'name' => $company->name(),
            'address' => $company->address(),
            'status' => $company->status(),
            'logo' => $company->logo(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
