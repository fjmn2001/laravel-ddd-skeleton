<?php


namespace Medine\ERP\Provider\Domain\ValueObjects;


class ProviderName
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value()
    {
        $this->name;
    }
}
