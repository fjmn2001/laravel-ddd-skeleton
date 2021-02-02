<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Find;


use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Roles\Application\RolResponse;

final class CompanyFinder
{
    private $finder;

    public function __construct(\Medine\ERP\Company\Domain\Service\CompanyFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(CompanyFinderRequest $request): RolResponse
    {
        $rol = ($this->finder)(new CompanyId($request->id()));

        return new RolResponse(
            $rol->id()->value(),
            $rol->name()->value(),
            $rol->description()->value(),
            $rol->superuser()->value(),
            $rol->status()->value()
        );
    }
}
