<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Creator;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDni;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientLastname;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;

final class ClientCreator
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientCreatorRequest $request)
    {
        $client = Client::create(
            new ClientId($request->id()),
            new ClientName($request->name()),
            new ClientLastname($request->lastmane()),
            new ClientDni($request->dni()),
            new ClientDniType($request->dniType()),
            new ClientClientType($request->clientType()),
            new ClientClientCategory($request->clientCategory()),
            new ClientFrequentClientNumber($request->frequentClientNumber()),
            new ClientState($request->state()),
        );

        $this->repository->save($client);
    }
}
