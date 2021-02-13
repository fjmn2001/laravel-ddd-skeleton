<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Domain\Entity;

use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductCreatedAt;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
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
    private $categoryId;
    private $description;
    private $typeId;
    private $state;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        ProductCategory $category,
        ProductDescription $description,
        ProductType $type,
        ProductState $state,
        ProductCreatedAt $createAt,
        ProductUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->categoryId = $category;
        $this->description = $description;
        $this->typeId = $type;
        $this->state = $state;
        $this->createdAt = $createAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        ProductCategory $category,
        ProductDescription $description,
        ProductType $type
    ): self
    {
        return new self(
            $id,
            $code,
            $name,
            $category,
            $description,
            $type,
            new ProductState('activo'),
            new ProductCreatedAt(),
            new ProductUpdatedAt()
        );
    }

    public static function fromValues(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        ProductCategory $category,
        ProductDescription $description,
        ProductType $type,
        ProductState $state,
        ProductCreatedAt $createAt,
        ProductUpdatedAt $updatedAt
    ): self
    {
        return new self(
            $id,
            $code,
            $name,
            $category,
            $description,
            $type,
            $state,
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

    public function categoryId(): ProductCategory
    {
        return $this->categoryId;
    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function typeId(): ProductType
    {
        return $this->typeId;
    }

    public function state(): ProductState
    {
        return $this->state;
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

    public function changeCategoryId(ProductCategory $newCategoryId): void
    {
        if (false === ($this->categoryId()->equals($newCategoryId))) {
            $this->categoryId = $newCategoryId;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeDescription(ProductDescription $newDescription): void
    {
        if (false === ($this->description()->equals($newDescription))) {
            $this->name = $newDescription;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeTypeId(ProductType $newTypeId): void
    {
        if (false === ($this->typeId()->equals($newTypeId))) {
            $this->typeId = $newTypeId;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

    public function changeState(ProductState $newState): void
    {
        if (false === ($this->name()->equals($newState))) {
            $this->description = $newState;
            $this->updatedAt = new ProductUpdatedAt();
        }
    }

}
