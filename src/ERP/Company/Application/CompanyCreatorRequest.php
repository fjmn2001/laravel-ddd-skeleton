<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Application;


final class CompanyCreatorRequest
{

    private $id;
    private $name;
    private $address;
    private $status;
    private $logo;

    public function __construct(
        string $id,
        string $name,
        string $address,
        string $status,
        string $logo
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->status = $status;
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

    public function address(): string
    {
        return $this->address;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function logo(): string
    {
        return $this->logo;
    }
}
