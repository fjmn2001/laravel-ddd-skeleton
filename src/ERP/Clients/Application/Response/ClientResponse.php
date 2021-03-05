<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Response;


final class ClientResponse
{
    private $id;
    private $name;
    private $lastname;
    private $dni;
    private $dniType;
    private $clientType;
    private $clientCategory;
    private $frequentClientNumber;
    private $state;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        $id,
        $name,
        $lastname,
        $dni,
        $dniType,
        $clientType,
        $clientCategory,
        $frequentClientNumber,
        $state,
        $createdAt,
        $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->dni = $dni;
        $this->dniType = $dniType;
        $this->clientType = $clientType;
        $this->clientCategory = $clientCategory;
        $this->frequentClientNumber = $frequentClientNumber;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function dni()
    {
        return $this->dni;
    }

    public function dniType()
    {
        return $this->dniType;
    }

    public function clientType()
    {
        return $this->clientType;
    }

    public function clientCategory()
    {
        return $this->clientCategory;
    }

    public function frequentClientNumber()
    {
        return $this->frequentClientNumber;
    }

    public function state()
    {
        return $this->state;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

    public function updatedAt()
    {
        return $this->updatedAt;
    }
}
