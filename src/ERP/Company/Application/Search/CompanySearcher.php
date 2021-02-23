<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Search;

use Medine\ERP\Company\Application\Response\CompaniesResponse;
use Medine\ERP\Company\Application\Response\CompanyResponse;
use Medine\ERP\Company\Domain\Company;
use Medine\ERP\Company\Domain\CompanyRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class CompanySearcher
{
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CompanySearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );
        return new CompaniesResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return static function (Company $company) {
            return new CompanyResponse(
                $company->id()->value(),
                $company->name()->value(),
                $company->address()->value(),
                $company->state()->value(),
                $company->logo()->value(),
                $company->createdAt()->format('d/m/Y')
            );
        };
    }
}
