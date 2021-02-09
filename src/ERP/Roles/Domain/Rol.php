<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

use Medine\ERP\Roles\Domain\ValueObjects\RolCompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolCreatedAt;
use Medine\ERP\Roles\Domain\ValueObjects\RolDescription;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Roles\Domain\ValueObjects\RolName;
use Medine\ERP\Roles\Domain\ValueObjects\RolState;
use Medine\ERP\Roles\Domain\ValueObjects\RolSuperuser;
use Medine\ERP\Roles\Domain\ValueObjects\RolUpdatedAt;

final class Rol
{
    const STATUS_ACTIVE = 'active';

    private $id;
    private $name;
    private $description;
    private $superuser;
    private $state;
    private $companyId;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        RolId $id,
        RolName $name,
        ?RolDescription $description,
        RolSuperuser $superuser,
        RolState $state,
        RolCompanyId $companyId,
        RolCreatedAt $createdAt,
        RolUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->superuser = $superuser;
        $this->state = $state;
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
            new RolState(self::STATUS_ACTIVE),
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
        RolState $state,
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
            $state,
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

    public function state(): RolState
    {
        return $this->state;
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

    public function changeState(RolState $newValue)
    {
        if (false === ($this->state()->equals($newValue))) {
            $this->state = $newValue;
            $this->updatedAt = new RolUpdatedAt();
        }
    }
}
