<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Response;


final class ClientsResponse
{
    private $clients;

    public function __construct(ClientResponse ...$clients)
    {
        $this->clients = $clients;
    }

    public function clients()
    {
        return $this->clients;
    }

}
