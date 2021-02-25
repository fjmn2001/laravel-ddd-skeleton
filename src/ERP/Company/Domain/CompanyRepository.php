<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Domain;

use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Shared\Domain\Criteria;

interface CompanyRepository
{
    public function find(CompanyId $id): ?Company;

    public function save(Company $company): void;

    public function update(Company $company): void;

    public function matching(Criteria $criteria);
}
