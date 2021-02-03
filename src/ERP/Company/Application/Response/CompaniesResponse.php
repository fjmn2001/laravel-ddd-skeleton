<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Response;

final class CompaniesResponse
{
    private $company;

    public function __construct(CompanyResponse ...$company)
    {
        $this->company = $company;
    }

    public function companies(): array
    {
        return $this->company;
    }
}
