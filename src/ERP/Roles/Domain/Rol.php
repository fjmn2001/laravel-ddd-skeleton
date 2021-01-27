<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

final class Rol
{
    private $id;
    private $name;
    private $description;
    private $superuser;

    private function __construct(
        string $id,
        string $name,
        ?string $description,
        string $superuser
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->superuser = $superuser;
    }

    public static function create(string $id, string $name, ?string $description, string $superuser): self
    {
        return new self(
            $id,
            $name,
            $description,
            $superuser
        );
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
}
