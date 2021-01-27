<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

final class RolUpdaterRequest
{
    private $id;
    private $name;
    private $description;
    private $superuser;
    private $status;

    public function __construct(
        string $id,
        string $name,
        ?string $description,
        string $superuser,
        string $status
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->superuser = $superuser;
        $this->status = $status;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function superuser(): string
    {
        return $this->superuser;
    }

    public function status(): string
    {
        return $this->status;
    }
}
