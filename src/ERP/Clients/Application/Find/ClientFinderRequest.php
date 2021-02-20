<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Find;


final class ClientFinderRequest
{

    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

}
