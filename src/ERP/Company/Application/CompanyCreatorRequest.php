<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Application;


final class CompanyCreatorRequest
{

    private $id;
    private $name;
    private $status;
    private $logo;
    private $userId;

    public function __construct(
        string $id,
        string $name,
        string $status,
        string $logo,
        string $userId
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->logo = $logo;
        $this->userId = $userId;
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

    public function userId(): string
    {
        return $this->userId;
    }
}
