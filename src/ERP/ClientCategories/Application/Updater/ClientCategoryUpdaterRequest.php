<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Application\Updater;


final class ClientCategoryUpdaterRequest
{
    private $id;
    private $companyId;
    private $name;
    private $description;
    private $state;

    public function __construct(
        string $id,
        string $companyId,
        string $name,
        string $description,
        string $state
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function companyId(): string
    {
        return $this->companyId;
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

}
