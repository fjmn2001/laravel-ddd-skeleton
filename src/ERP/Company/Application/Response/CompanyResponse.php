<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Response;

final class CompanyResponse
{
    private $id;
    private $name;
    private $address;
    private $state;
    private $logo;
    private $createdAt;
    private $usersQuantity;
    private $stateValue;

    public function __construct(
        $id,
        $name,
        $address,
        $state,
        $logo,
        string $createdAt,
        int $usersQuantity,
        string $stateValue
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->state = $state;
        $this->logo = $logo;
        $this->createdAt = $createdAt;
        $this->usersQuantity = $usersQuantity;
        $this->stateValue = $stateValue;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function address()
    {
        return $this->address;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function logo()
    {
        return $this->logo;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function usersQuantity()
    {
        return $this->usersQuantity;
    }

    public function stateValue(): string
    {
        return $this->stateValue;
    }
}
