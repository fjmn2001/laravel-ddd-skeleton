<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Application;


use Medine\ERP\Company\Domain\CompanyHasUser;
use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyHasUserRepository;
use Medine\ERP\Company\Domain\CompanyRepository;

final class CompanyCreator
{
    private $repository;
    private $companyHasUsersRepository;

    public function __construct(
        CompanyRepository $repository,
        CompanyHasUserRepository $companyHasUserRepository
    )
    {
        $this->repository = $repository;
        $this->companyHasUserRepository = $companyHasUserRepository;
    }

    public function __invoke(CompanyCreatorRequest $request): void
    {
        $company = new Company(
            $request->id(),
            $request->name(),
            $request->status(),
            $request->logo()
        );

        //todo: create rol!!!
        $rol = null;//

        $companyHasUser = CompanyHasUser::create(
            $request->id(),
            $request->userId(),
            $rol->id()
        );

        $this->repository->save($company);
        $this->companyHasUserRepository->save($companyHasUser);
    }
}
