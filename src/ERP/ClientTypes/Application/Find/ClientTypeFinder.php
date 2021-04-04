<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Application\Find;


use Medine\ERP\ClientTypes\Application\Response\ClientTypeResponse;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;

final class ClientTypeFinder
{
    private $finder;

    public function __construct(\Medine\ERP\ClientTypes\Domain\Service\ClientTypeFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ClientTypeFinderRequest $request)
    {
        $clientType = ($this->finder)(new ClientTypeId($request->id()));
        return new ClientTypeResponse(
            $clientType->id()->value(),
            $clientType->companyId()->value(),
            $clientType->name()->value(),
            $clientType->description()->value(),
            $clientType->state()->value(),
        );
    }
}
