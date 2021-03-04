<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Response;

final class ItemCategoryResponse
{

    private $id;
    private $name;
    private $description;
    private $state;
    private $companyId;

    public function __construct(string $id, string $name, string $description, string $state, string $companyId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->companyId = $companyId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }
}
