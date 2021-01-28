<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application;

use Medine\ERP\Company\Domain\CompanyHasUser;
use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyHasUserRepository;
use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Company\Domain\ValueObjects\CompanyAddress;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Company\Domain\ValueObjects\CompanyLogo;
use Medine\ERP\Company\Domain\ValueObjects\CompanyName;
use Medine\ERP\Company\Domain\ValueObjects\CompanyStatus;
use Medine\ERP\Roles\Domain\Rol;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;
use Ramsey\Uuid\Uuid;

final class CompanyCreator
{
    private $repository;
    private $rolRepository;
    private $companyHasUserRepository;

    public function __construct(
        CompanyRepository $repository,
        RolRepository $rolRepository,
        CompanyHasUserRepository $companyHasUserRepository
    )
    {
        $this->repository = $repository;
        $this->rolRepository = $rolRepository;
        $this->companyHasUserRepository = $companyHasUserRepository;
    }

    public function __invoke(CompanyCreatorRequest $request): void
    {
        $company = Company::create(
            new CompanyId($request->id()),
            new CompanyName($request->name()),
            new CompanyAddress($request->address()),
            new CompanyStatus($request->status()),
            new CompanyLogo($request->logo())
        );

        $rol = Rol::create(
            new RolId(Uuid::uuid4()->toString()),
            new RolName('Admin'),
            new RolDescription('rol of admin'),
            new RolSuperuser('yes'),
            new RolCompanyId($request->id()),
        );

        $companyHasUser = CompanyHasUser::create(
            new CompanyId($request->id()),
            $request->userId(),
            $rol->id()
        );

        $this->repository->save($company);
        $this->rolRepository->save($rol);
        $this->companyHasUserRepository->save($companyHasUser);
    }
}
