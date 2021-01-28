<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolCreatedAt;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolStatus;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;
use Medine\ERP\Roles\Domain\ValueObjects\RolUpdatedAt;

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
        RolCreatedAt $createdAt,
        RolUpdatedAt $updatedAt
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
            new RolCreatedAt(),
            new RolUpdatedAt(),
        );
    }

    public static function fromDatabase(
        RolId $id,
        RolName $name,
        ?RolDescription $description,
        RolSuperuser $superuser,
        RolStatus $status,
        RolCompanyId $companyId,
        RolCreatedAt $createdAt,
        RolUpdatedAt $updatedAt
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

    public function createdAt(): RolCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): RolUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeName(RolName $newName)
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
            $this->updatedAt = new RolUpdatedAt();
        }
    }

    public function changeDescription(RolDescription $newDescription)
    {
        if (false === ($this->description()->equals($newDescription))) {
            $this->description = $newDescription;
            $this->updatedAt = new RolUpdatedAt();
        }
    }

    public function changeSuperuser(RolSuperuser $newValue)
    {
        if (false === ($this->superuser()->equals($newValue))) {
            $this->superuser = $newValue;
            $this->updatedAt = new RolUpdatedAt();
        }
    }

    public function changeStatus(RolStatus $newValue)
    {
        if (false === ($this->status()->equals($newValue))) {
            $this->status = $newValue;
            $this->updatedAt = new RolUpdatedAt();
        }
    }
}
