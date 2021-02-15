<?php


namespace Medine\ERP\Provider\Domain\Entity;


use Medine\ERP\Provider\Domain\ValueObjects\ProviderCreatedAt;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderUpdatedAt;

final class Provider
{
    private $id;
    private $name;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        ProviderId $id,
        ProviderName $name,
        ProviderCreatedAt $createdAt,
        ProviderUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ProviderId $id,
        ProviderName $name
    )
    {
        return new self(
            $id,
            $name,
            new ProviderCreatedAt(),
            new ProviderUpdatedAt()
        );
    }

    public static function fromDatabase(
        ProviderId $id,
        ProviderName $name,
        ProviderCreatedAt $createdAt,
        ProviderUpdatedAt $updatedAt
    )
    {
        return new self(
            $id,
            $name,
            $createdAt,
            $updatedAt
        );
    }

    public function id(): ProviderId
    {
        return $this->id;
    }

    public function name(): ProviderName
    {
        return $this->name;
    }

    public function createdAt(): ProviderCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProviderUpdatedAt
    {
        return $this->updatedAt;
    }

    public function changeName(ProviderName $newName)
    {
        if(false === ($this->name()->equals($newName))){
            $this->name = $newName;
            $this->updatedAt = new ProviderUpdatedAt();
        }
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }
}
