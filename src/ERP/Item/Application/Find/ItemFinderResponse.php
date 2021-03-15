<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Application\Find;

final class ItemFinderResponse
{
    private $id;
    private $code;
    private $name;
    private $categoryId;
    private $reference;
    private $typeId;
    private $state;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $categoryId,
        string $reference,
        string $typeId,
        string $state
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->reference = $reference;
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

    public function reference(): string
    {
        return $this->reference;
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
