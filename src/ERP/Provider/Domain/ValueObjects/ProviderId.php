<?php


namespace Medine\ERP\Provider\Domain\ValueObjects;


class ProviderId
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }
}
