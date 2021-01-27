<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


interface CompanyHasUserRepository
{
    public function save(CompanyHasUser $companyHasUser): void;
}
