<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Find;


use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

final class ClientFinder
{
    private $finder;

    public function __construct(\Medine\ERP\Clients\Domain\Service\ClientFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(ClientFinderRequest $request)
    {
        $client = ($this->finder)(new ClientId($request->id()));
    }

}
