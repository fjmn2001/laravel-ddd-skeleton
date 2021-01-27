<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class Company
{

    private $id;
    private $name;
    private $status;
    private $logo;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        string $id,
        string $name,
        string $status,
        string $logo,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->logo = $logo;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        string $id,
        string $name,
        string $status,
        string $logo
    ): self
    {
        return new self(
            $id,
            $name,
            $status,
            $logo,
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
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

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
