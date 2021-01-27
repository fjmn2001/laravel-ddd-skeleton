<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Find;

use Medine\ERP\Roles\Application\RolResponse;
use Medine\ERP\Roles\Application\Update\RolNotExistsException;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;

final class RolFinder
{
    private $repository;

    public function __construct(RolRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RolFinderRequest $request): RolResponse
    {
        $rol = $this->repository->find(new RolId($request->id()));

        if (null === $rol) {
            throw new RolNotExistsException($request->id());
        }

        return new RolResponse(
            $rol->id()->value(),
            $rol->name()->value(),
            $rol->description()->value(),
            $rol->superuser()->value(),
            $rol->status()->value()
        );
    }
}
