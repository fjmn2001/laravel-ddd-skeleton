<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Domain\Service;


use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;

final class ClientTypeFinder
{
    private $repository;

    public function __construct(
        ClientTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientTypeId $id)
    {
        $clientType = $this->repository->find($id);
        if (null === $clientType) {
            throw new ClientTypeNotExistsException($id);
        }

        return $clientType;
    }
}
