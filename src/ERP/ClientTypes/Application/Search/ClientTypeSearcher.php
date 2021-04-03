<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Search;

use Medine\ERP\ClientTypes\Application\Response\ClientTypeResponse;
use Medine\ERP\ClientTypes\Application\Response\ClientTypesResponse;
use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Entity\ClientType;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class ClientTypeSearcher
{

    private $repository;

    public function __construct(
        ClientTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientTypeSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new ClientTypesResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (ClientType $clientType) {
            return new ClientTypeResponse(
                $clientType->id()->value(),
                $clientType->companyId()->value(),
                $clientType->name()->value(),
                $clientType->description()->value(),
                $clientType->state()->value(),
            );
        };
    }
}
