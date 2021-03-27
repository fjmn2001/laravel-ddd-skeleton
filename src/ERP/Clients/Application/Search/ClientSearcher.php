<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Application\Search;

use Medine\ERP\Clients\Application\Response\ClientResponse;
use Medine\ERP\Clients\Application\Response\ClientsResponse;
use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class ClientSearcher
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new ClientsResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (Client $client) {
            return new ClientResponse(
                $client->id()->value(),
                $client->companyId()->value(),
                $client->name()->value(),
                $client->lastname()->value(),
                $client->dni()->value(),
                $client->dniType()->value(),
                $client->clientType()->value(),
                $client->clientCategory()->value(),
                $client->frequentClientNumber()->value(),
                $client->state()->value(),
                $client->createdAt()->format('d/m/Y'),
                $client->updatedAt()->format('d/m/Y'),
                $client->phones(),
                $client->emails()
            );
        };
    }

}
