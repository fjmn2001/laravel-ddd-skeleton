<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Application\Find;


final class ClientTypeFinderRequest
{
    private $id;

    public function __construct(
        string $id
    )
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
