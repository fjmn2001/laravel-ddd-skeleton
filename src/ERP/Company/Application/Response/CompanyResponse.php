<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Application\Response;

final class CompanyResponse
{
    private $id;
    private $name;
    private $address;
    private $status;
    private $logo;

    public function __construct(
        $id,
        $name,
        $address,
        $status,
        $logo
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

    public function address()
    {
        return $this->address;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function logo()
    {
        return $this->logo;
    }
}
