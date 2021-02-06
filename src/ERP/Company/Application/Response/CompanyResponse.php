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

    public function __construct(
        $id,
        $name,
        $address,
        $state,
        $logo
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->state = $state;
        $this->logo = $logo;
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
}
