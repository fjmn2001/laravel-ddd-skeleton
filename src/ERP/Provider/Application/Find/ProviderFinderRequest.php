<?php


namespace Medine\ERP\Provider\Application\Find;


class ProviderFinderRequest
{

    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
