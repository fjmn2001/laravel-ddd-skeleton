<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Updater;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;

final class ClientUpdater
{
    private $repository;

    public function __construct(
        ClientRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientUpdaterRequest $request)
    {
        $client = $this->repository->find(new ClientId($request->id()));

        $client->changeName(new ClientName($request->name()));
        $client->changeDniType(new ClientDniType($request->dniType()));
        $client->changeClientType(new ClientClientType($request->clientType()));
        $client->changeClientCategory(new ClientClientCategory($request->clientCategory()));
        $client->changeFrequentClientNumbrer(new ClientFrequentClientNumber($request->frequentClientNumber()));
        $client->changeState(new ClientState($request->state()));

        $this->repository->update($client);
    }

}
