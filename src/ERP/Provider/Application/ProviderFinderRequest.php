<?php


namespace Medine\ERP\Provider\Application;


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
