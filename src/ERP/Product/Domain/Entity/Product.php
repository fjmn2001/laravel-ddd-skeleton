<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Domain\Entity;

use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductCreatedAt;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Medine\ERP\Product\Domain\ValueObjects\ProductUpdatedAt;

final class Product
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
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $categoryId,
        ProductState $state,
        string $companyId,
        int $createdBy,
        int $updatedBy,
        ProductCreatedAt $createAt,
        ProductUpdatedAt $updatedAt
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
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $category,
        ProductState $state,
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
            new ProductCreatedAt(),
            new ProductUpdatedAt()
        );
    }

    public static function fromValues(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $categoryId,
        ProductState $state,
        string $companyId,
        int $createdBy,
        int $updatedBy,
        ProductCreatedAt $createAt,
        ProductUpdatedAt $updatedAt
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

    public function id(): ProductId
    {
        return $this->id;
    }

    public function code(): ProductCode
    {
        return $this->code;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function type(): ProductType
    {
        return $this->type;
    }

    public function categoryId(): ProductCategoryId
    {
        return $this->categoryId;
    }

    public function state(): ProductState
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

    public function createdAt(): ProductCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProductUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeCode(ProductCode $newCode): void
    {
        if (false === ($this->code()->equals($newCode))) {
            $this->code = $newCode;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeName(ProductName $newName): void
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeReference(string $reference): void
    {
        if (false === ($this->reference === $reference)) {
            $this->reference = $reference;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeCategoryId(ProductCategoryId $newCategoryId): void
    {
        if (false === ($this->categoryId()->equals($newCategoryId))) {
            $this->categoryId = $newCategoryId;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeType(ProductType $newType): void
    {
        if (false === ($this->type()->equals($newType))) {
            $this->type = $newType;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeState(ProductState $newState): void
    {
        if (false === ($this->state()->equals($newState))) {
            $this->state = $newState;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeUpdatedBy(int $newUpdatedBy): void
    {
        if (false === ($this->updatedBy === $newUpdatedBy)) {
            $this->updatedBy = $newUpdatedBy;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }
}
