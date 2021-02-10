<?php


namespace Medine\ERP\Provider\Domain\Entity;


final class Provider
{
    private $id;
    private $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(
        string $id,
        string $name
    ){
        return new self(
            $id,
            $name
        );
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
