<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Domain\Entity;


use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeCompanyId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeCreatedAt;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeDescription;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeName;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeState;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeUpdatedAt;

final class ClientType
{

    private $id;
    private $companyId;
    private $name;
    private $description;
    private $state;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        ClientTypeId $id,
        ClientTypeCompanyId $companyId,
        ClientTypeName $name,
        ClientTypeDescription $description,
        ClientTypeState $state,
        ClientTypeCreatedAt $createdAt,
        ClientTypeUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ClientTypeId $id,
        ClientTypeCompanyId $companyId,
        ClientTypeName $name,
        ClientTypeDescription $description,
        ClientTypeState $state
    ): self
    {
        return new self(
            $id,
            $companyId,
            $name,
            $description,
            $state,
            new ClientTypeCreatedAt(),
            new ClientTypeUpdatedAt()
        );
    }

    public function id(): ClientTypeId
    {
        return $this->id;
    }

    public function CompanyId(): ClientTypeCompanyId
    {
        return $this->companyId;
    }

    public function name(): ClientTypeName
    {
        return $this->name;
    }

    public function description(): ClientTypeDescription
    {
        return $this->description;
    }

    public function state(): ClientTypeState
    {
        return $this->state;
    }

    public function createdAt(): ClientTypeCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ClientTypeUpdatedAt
    {
        return $this->updatedAt;
    }

}
