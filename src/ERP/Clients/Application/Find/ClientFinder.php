<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Find;


use Medine\ERP\Clients\Application\Response\ClientResponse;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

final class ClientFinder
{
    private $finder;

    public function __construct(\Medine\ERP\Clients\Domain\Service\ClientFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ClientFinderRequest $request): ClientResponse
    {
        $client = ($this->finder)(new ClientId($request->id()));

        return new ClientResponse(
            $client->id()->value(),
            $client->name()->value(),
            $client->lastname()->value(),
            $client->dni()->value(),
            $client->dniType()->value(),
            $client->clientType()->value(),
            $client->clientCategory()->value(),
            $client->frequentClientNumber()->value(),
            $client->state()->value(),
            $client->createdAt()->format('d/m/Y'),
            $client->updatedAt()->format('d/m/Y')
        );
    }

}
