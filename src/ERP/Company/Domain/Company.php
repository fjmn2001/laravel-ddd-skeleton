<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


use Medine\ERP\Company\Domain\ValueObjects\CompanyAddress;
use Medine\ERP\Company\Domain\ValueObjects\CompanyCreatedAt;
use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Company\Domain\ValueObjects\CompanyLogo;
use Medine\ERP\Company\Domain\ValueObjects\CompanyName;
use Medine\ERP\Company\Domain\ValueObjects\CompanyStatus;
use Medine\ERP\Company\Domain\ValueObjects\CompanyUpdatedAt;

final class Company
{

    private $id;
    private $name;
    private $address;
    private $status;
    private $logo;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        CompanyId $id,
        CompanyName $name,
        CompanyAddress $address,
        CompanyStatus $status,
        CompanyLogo $logo,
        CompanyCreatedAt $createdAt,
        CompanyUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->status = $status;
        $this->logo = $logo;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        CompanyId $id,
        CompanyName $name,
        CompanyAddress $address,
        CompanyStatus $status,
        CompanyLogo $logo
    ): self
    {
        return new self(
            $id,
            $name,
            $address,
            $status,
            $logo,
            new CompanyCreatedAt(),
            new CompanyUpdatedAt()
        );
    }

    public static function fromDatabase(
        CompanyId $id,
        CompanyName $name,
        CompanyAddress $address,
        CompanyStatus $status,
        CompanyLogo $logo,
        CompanyCreatedAt $createdAt,
        CompanyUpdatedAt $updatedAt
    ): self
    {
        return new self(
            $id,
            $name,
            $address,
            $status,
            $logo,
            $createdAt,
            $updatedAt
        );
    }

    public function id(): CompanyId
    {
        return $this->id;
    }

    public function name(): CompanyName
    {
        return $this->name;
    }

    public function address(): CompanyAddress
    {
        return $this->address;
    }

    public function status(): CompanyStatus
    {
        return $this->status;
    }

    public function logo(): CompanyLogo
    {
        return $this->logo;
    }

    public function createdAt(): CompanyCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): CompanyUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeName(CompanyName $newName): void
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
            $this->updatedAt = new CompanyUpdatedAt();
        }
    }

    public function changeAddress(CompanyAddress $newAddress): void
    {
        if (false === ($this->address()->equals($newAddress))) {
            $this->address = $newAddress;
            $this->updatedAt = new CompanyUpdatedAt();
        }
    }

    public function changeStatus(CompanyStatus $newStatus): void
    {
        if (false === ($this->status()->equals($newStatus))) {
            $this->status = $newStatus;
            $this->updatedAt = new CompanyUpdatedAt();
        }
    }

    public function changeLogo(CompanyLogo $newLogo): void
    {
        if (false === ($this->logo()->equals($newLogo))) {
            $this->logo = $newLogo;
            $this->updatedAt = new CompanyUpdatedAt();
        }
    }
}
