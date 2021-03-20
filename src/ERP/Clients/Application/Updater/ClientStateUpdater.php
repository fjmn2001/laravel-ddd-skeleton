<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Updater;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Service\ClientFinder;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;

final class ClientStateUpdater
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ClientFinder($repository);
    }

    public function __invoke(ClientStateUpdaterRequest $request)
    {
        $client = ($this->finder)(new ClientId(
           $request->id()
        ));

        $client->changeState(new ClientState($request->state()));

        $this->repository->update($client);
    }
}
