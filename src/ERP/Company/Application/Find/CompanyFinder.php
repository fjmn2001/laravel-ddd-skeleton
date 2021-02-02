<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Find;


use Medine\ERP\Company\Application\Response\CompanyResponse;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Roles\Application\RolResponse;

final class CompanyFinder
{
    private $finder;

    public function __construct(\Medine\ERP\Company\Domain\Service\CompanyFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(CompanyFinderRequest $request): CompanyResponse
    {
        $rol = ($this->finder)(new CompanyId($request->id()));

        return new CompanyResponse(
            $rol->id()->value(),
            $rol->name()->value(),
            $rol->status()->value(),
            $rol->address()->value(),
            $rol->status()->value()
        );
    }
}
