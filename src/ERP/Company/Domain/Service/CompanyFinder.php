<?php


namespace Medine\ERP\Company\Domain\Service;


use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;

class CompanyFinder
{
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CompanyId $id): Company
    {
        $company = $this->repository->find($id);

        if (null === $company) {
            throw new CompanyNotExistsException($id);
        }

        return $company;
    }
}
