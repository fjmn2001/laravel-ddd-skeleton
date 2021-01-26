<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Application;


use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;

final class CompanyCreator
{
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CompanyCreatorRequest $request): void
    {
        $company = new Company(
          $request->id(),
          $request->nombre(),
          $request->direccion()
        );

        $this->repository->save($company);
    }
}
