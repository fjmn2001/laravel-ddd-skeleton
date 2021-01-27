<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class Company
{

    private $id;
    private $name;
    private $status;
    private $logo;

    public function __construct(
        string $id,
        string $name,
        string $status,
        string $logo
    )
    {
        $this->id = $id;
        $this->name = $name;
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

    public function status(): string
    {
        return $this->status;
    }

    public function logo(): string
    {
        return $this->logo;
    }
}
