<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Create;

final class ItemCreatorRequest
{
    private $id;
    private $code;
    private $name;
    private $reference;
    private $type;
    private $categoryId;
    private $state;
    private $companyId;
    private $createdBy;

    public function __construct(
        string $id,
        string $code,
        string $name,
        ?string $reference,
        string $type,
        string $categoryId,
        string $state,
        string $companyId,
        int $createdBy
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

    public function reference(): ?string
    {
        return $this->reference;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function createdBy(): int
    {
        return $this->createdBy;
    }
}
