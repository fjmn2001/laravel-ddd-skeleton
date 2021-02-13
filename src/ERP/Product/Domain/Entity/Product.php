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
}
