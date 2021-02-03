<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application;

use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Domain\Service\CompanyFinder;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Company\Domain\ValueObjects\CompanyLogo;
use Medine\ERP\Company\Domain\ValueObjects\CompanyName;
use Medine\ERP\Company\Domain\ValueObjects\CompanyStatus;
use Medine\ERP\Company\Domain\ValueObjects\CompanyAddress;

class CompanyUpdater
{
    private $repository;
    private $finder;

    public function __construct(
        CompanyRepository $repository
    )
    {
        $this->repository = $repository;
        $this->finder = new CompanyFinder($repository);
    }

    public function __invoke(CompanyUpdaterRequest $request): void
    {
        $company = ($this->finder)(new CompanyId($request->id()));

        $company->changeName(new CompanyName($request->name()));
        $company->changeAddress(new CompanyAddress($request->address()));
        $company->changeStatus(new CompanyStatus($request->status()));
        $company->changeLogo(new CompanyLogo($request->logo()));

        $this->repository->update($company);
    }
}
