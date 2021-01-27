<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolStatus;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;

final class Rol
{
    const STATUS_ACTIVE = 'active';

    private $id;
    private $name;
    private $description;
    private $superuser;
    private $status;
    private $companyId;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        RolId $id,
        RolName $name,
        ?RolDescription $description,
        RolSuperuser $superuser,
        RolStatus $status,
        RolCompanyId $companyId,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->superuser = $superuser;
        $this->status = $status;
        $this->companyId = $companyId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        RolId $id,
        RolName $name,
        ?RolDescription $description,
        RolSuperuser $superuser,
        RolCompanyId $companyId
    ): self
    {
        return new self(
            $id,
            $name,
            $description,
            $superuser,
            new RolStatus(self::STATUS_ACTIVE),
            $companyId,
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
    }

    public static function fromDatabase(
        RolId $id,
        RolName $name,
        ?RolDescription $description,
        RolSuperuser $superuser,
        RolStatus $status,
        RolCompanyId $companyId,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ): self
    {
        return new self(
            $id,
            $name,
            $description,
            $superuser,
            $status,
            $companyId,
            $createdAt,
            $updatedAt
        );
    }

    public function id(): RolId
    {
        return $this->id;
    }

    public function name(): RolName
    {
        return $this->name;
    }

    public function description(): ?RolDescription
    {
        return $this->description;
    }

    public function superuser(): RolSuperuser
    {
        return $this->superuser;
    }

    public function status(): RolStatus
    {
        return $this->status;
    }

    public function companyId(): RolCompanyId
    {
        return $this->companyId;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function changeName(RolName $newName)
    {
        if (false === ($this->name()->equal($newName))) {
            $this->name = $newName;
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function changeDescription(RolDescription $newDescription)
    {
        if (false === ($this->description()->equal($newDescription))) {
            $this->description = $newDescription;
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function changeSuperuser(RolSuperuser $newValue)
    {
        if (false === ($this->superuser()->equal($newValue))) {
            $this->superuser = $newValue;
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function changeStatus(RolStatus $newValue)
    {
        if (false === ($this->status()->equal($newValue))) {
            $this->status = $newValue;
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
}
