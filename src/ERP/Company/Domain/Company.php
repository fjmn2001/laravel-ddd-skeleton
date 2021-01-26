<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class Company
{
    private $id;
    private $nombre;
    private $direccion;

    public function __construct(
        string $id,
        string $nombre,
        string $direccion
    )
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function direccion(): string
    {
        return $this->direccion;
    }
}
