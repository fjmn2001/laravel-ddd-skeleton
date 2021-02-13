<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Update;

final class UpdateProductRequest
{
    private $id;
    private $code;
    private $name;
    private $categoryId;
    private $description;
    private $typeId;
    private $state;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $categoryId,
        string $description,
        string $typeId,
        string $state
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->description = $description;
        $this->typeId = $typeId;
        $this->state = $state;
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

    public function state(): string
    {
        return $this->state;
    }

}
