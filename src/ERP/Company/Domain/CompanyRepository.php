<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


use Medine\ERP\Company\Domain\ValueObjects\CompanyId;

interface CompanyRepository
{
    public function find(CompanyId $id): ?Company;
    public function save(Company $company): void;
    public function update(Company $company): void;
}
