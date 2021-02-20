<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Service;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

final class ClientFinder
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientId $id)
    {
        $client = $this->repository->find($id);
        if (null === $client) {
            throw new ClientNotExistsException($id);
        }

        return $client;
    }

}
