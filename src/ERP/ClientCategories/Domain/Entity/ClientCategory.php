<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Domain\Entity;

use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryCompanyId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryCreatedAt;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryDescription;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryName;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryUpdatedAt;

final class ClientCategory
{

    private $id;
    private $companyId;
    private $name;
    private $description;
    private $state;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        ClientCategoryId $id,
        ClientCategoryCompanyId $companyId,
        ClientCategoryName $name,
        ClientCategoryDescription $description,
        ClientCategoryState $state,
        ClientCategoryCreatedAt $createdAt,
        ClientCategoryUpdatedAt $updatedAt
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
        ClientCategoryId $id,
        ClientCategoryCompanyId $companyId,
        ClientCategoryName $name,
        ClientCategoryDescription $description,
        ClientCategoryState $state
    ): self
    {
        return new self(
            $id,
            $companyId,
            $name,
            $description,
            $state,
            new ClientCategoryCreatedAt(),
            new ClientCategoryUpdatedAt()
        );
    }

    public static function fromDatabase(
        ClientCategoryId $id,
        ClientCategoryCompanyId $companyId,
        ClientCategoryName $name,
        ClientCategoryDescription $description,
        ClientCategoryState $state,
        ClientCategoryCreatedAt $createdAt,
        ClientCategoryUpdatedAt $updatedAt

    ): self
    {
        return new self(
            $id,
            $companyId,
            $name,
            $description,
            $state,
            $createdAt,
            $updatedAt
        );
    }

    public function id(): ClientCategoryId
    {
        return $this->id;
    }

    public function companyId(): ClientCategoryCompanyId
    {
        return $this->companyId;
    }

    public function name(): ClientCategoryName
    {
        return $this->name;
    }

    public function description(): ClientCategoryDescription
    {
        return $this->description;
    }

    public function state(): ClientCategoryState
    {
        return $this->state;
    }

    public function createdAt(): ClientCategoryCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ClientCategoryUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeName(ClientCategoryName $newName): void
    {
        if(false == ($this->name()->equals($newName))){
            $this->name = $newName;
            $this->updatedAt = new ClientCategoryUpdatedAt();
        }
    }

    public function changeDescription(ClientCategoryDescription $newDescription): void
    {
        if(false == ($this->description()->equals($newDescription))){
            $this->description = $newDescription;
            $this->updatedAt = new ClientCategoryUpdatedAt();
        }
    }

    public function changeState(ClientCategoryState $newState): void
    {
        if(false == ($this->state()->equals($newState))){
            $this->state = $newState;
            $this->updatedAt = new ClientCategoryUpdatedAt();
        }
    }

}
