<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Response;

final class ClientTypesResponse
{
    private $clientType;

    public function __construct(ClientTypeResponse ...$clientType)
    {
        $this->clientType = $clientType;
    }

    public function clientType(): array
    {
        return $this->clientType;
    }

}
