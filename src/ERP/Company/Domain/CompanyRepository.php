<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


interface CompanyRepository
{
    public function save(Company $company): void;
}
