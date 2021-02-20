<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Create;

final class CreateProductRequest
{
    private $id;
    private $code;
    private $name;
    private $categoryId;
    private $description;
    private $typeId;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $category,
        string $description,
        string $type
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->categoryId = $category;
        $this->description = $description;
        $this->typeId = $type;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function typeId(): string
    {
        return $this->typeId;
    }

}
