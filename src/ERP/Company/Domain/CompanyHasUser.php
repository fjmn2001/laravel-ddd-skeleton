<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


use Medine\ERP\Company\Domain\ValueObjects\CompanyId;
use Medine\ERP\Roles\Domain\ValueObjects\RolId;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;

final class CompanyHasUser
{
    private $id;
    private $companyId;
    private $userId;
    private $rolId;
    private $state;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        string $id,
        CompanyId $companyId,
        string $userId,
        RolId $rolId,
        string $state,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->userId = $userId;
        $this->rolId = $rolId;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        CompanyId $companyId,
        string $userId,
        RolId $rolId
    ): self
    {
        return new self(
            Uuid::random()->value(),
            $companyId,
            $userId,
            $rolId,
            'todo: valueobje for status',
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
    }
    public function id(): string
    {
        return $this->id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function rolId(): RolId
    {
        return $this->rolId;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
