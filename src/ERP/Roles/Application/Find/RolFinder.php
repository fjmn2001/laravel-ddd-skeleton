<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Find;

use Medine\ERP\Roles\Application\RolResponse;
use Medine\ERP\Roles\Domain\RolRepository;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;

final class RolFinder
{
    private $finder;

    public function __construct(\Medine\ERP\Roles\Domain\Service\RolFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(RolFinderRequest $request): RolResponse
    {
        $rol = ($this->finder)(new RolId($request->id()));

        return new RolResponse(
            $rol->id()->value(),
            $rol->name()->value(),
            $rol->description()->value(),
            $rol->superuser()->value(),
            $rol->state()->value()
        );
    }
}
