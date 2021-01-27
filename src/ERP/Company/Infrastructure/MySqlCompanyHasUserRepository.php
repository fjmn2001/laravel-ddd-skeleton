<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Infrastructure;


use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyHasUserRepository;

final class MySqlCompanyHasUserRepository implements CompanyHasUserRepository
{

    public function save(Company $company): void
    {
        // TODO: Implement save() method.
    }
}
