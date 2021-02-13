<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Company\Infrastructure;

use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Shared\Domain\Criteria;
use function Lambdish\Phunctional\search;

final class InMemoryCompanyRepository implements CompanyRepository
{
    private $company = [];

    public function save(Company $rol): void
    {
        $this->company[] = $rol;
    }

    public function find(CompanyId $id): ?Company
    {
        return search(function (Company $rol) use ($id) {
            return $rol->id()->equals($id);
        }, $this->company);
    }

    public function update(Company $rol): void
    {
        // TODO: Implement update() method.
    }

    public function matching(Criteria $criteria)
    {
        // TODO: Implement matching() method.
    }
}
