<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Domain\Entity;

use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemCreatedAt;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;
use Medine\ERP\Item\Domain\ValueObjects\ItemUpdatedAt;

final class Item
{
    private $id;
    private $code;
    private $name;
    private $reference;
    private $type;
    private $categoryId;
    private $state;
    private $averageCost = 0;//todo remove it
    private $companyId;
    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $categoryId,
        ItemState $state,
        string $companyId,
        int $createdBy,
        int $updatedBy,
        ItemCreatedAt $createAt,
        ItemUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->reference = $reference;
        $this->type = $type;
        $this->categoryId = $categoryId;
        $this->state = $state;
        $this->companyId = $companyId;
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
        $this->createdAt = $createAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $category,
        ItemState $state,
        string $companyId,
        int $createdBy
    ): self
    {
        return new self(
            $id,
            $code,
            $name,
            $reference,
            $type,
            $category,
            $state,
            $companyId,
            $createdBy,
            $createdBy,
            new ItemCreatedAt(),
            new ItemUpdatedAt()
        );
    }

    public static function fromValues(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $categoryId,
        ItemState $state,
        string $companyId,
        int $createdBy,
        int $updatedBy,
        ItemCreatedAt $createAt,
        ItemUpdatedAt $updatedAt
    ): self
    {
        return new self(
            $id,
            $code,
            $name,
            $reference,
            $type,
            $categoryId,
            $state,
            $companyId,
            $createdBy,
            $updatedBy,
            $createAt,
            $updatedAt
        );
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function code(): ItemCode
    {
        return $this->code;
    }

    public function name(): ItemName
    {
        return $this->name;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function type(): ItemType
    {
        return $this->type;
    }

    public function categoryId(): ItemCategoryId
    {
        return $this->categoryId;
    }

    public function state(): ItemState
    {
        return $this->state;
    }

    public function averageCost(): float
    {
        return $this->averageCost;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function createdBy(): int
    {
        return $this->createdBy;
    }

    public function updatedBy(): int
    {
        return $this->updatedBy;
    }

    public function createdAt(): ItemCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ItemUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeCode(ItemCode $newCode): void
    {
        if (false === ($this->code()->equals($newCode))) {
            $this->code = $newCode;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeName(ItemName $newName): void
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeReference(string $reference): void
    {
        if (false === ($this->reference === $reference)) {
            $this->reference = $reference;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeCategoryId(ItemCategoryId $newCategoryId): void
    {
        if (false === ($this->categoryId()->equals($newCategoryId))) {
            $this->categoryId = $newCategoryId;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeType(ItemType $newType): void
    {
        if (false === ($this->type()->equals($newType))) {
            $this->type = $newType;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeState(ItemState $newState): void
    {
        if (false === ($this->state()->equals($newState))) {
            $this->state = $newState;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }

    public function changeUpdatedBy(int $newUpdatedBy): void
    {
        if (false === ($this->updatedBy === $newUpdatedBy)) {
            $this->updatedBy = $newUpdatedBy;
            $this->updatedAt = new ItemUpdatedAt();
        }
    }
}
