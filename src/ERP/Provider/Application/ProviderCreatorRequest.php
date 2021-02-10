<?php


namespace Medine\ERP\Provider\Application;


class ProviderCreatorRequest
{
    private $id;
    private $name;

    public function __construct(string  $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }
}
