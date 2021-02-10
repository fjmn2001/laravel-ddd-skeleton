<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Entity;


use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientCreatedAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDni;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientLastname;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;
use Medine\ERP\Clients\Domain\ValueObjects\ClientUpdatedAt;

final class Client
{
    private $id;
    private $name;
    private $lastname;
    private $dni;
    private $dniType;
    private $clientType;
    private $clientCategory;
    private $frequentClientNumber;
    private $state;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        ClientId $id,
        ClientName $name,
        ClientLastname $lastname,
        ClientDni $dni,
        ClientDniType $dniType,
        ClientClientType $clientType,
        ClientClientCategory $clientCategory,
        ClientFrequentClientNumber $frequentClientNumber,
        ClientState $state,
        ClientCreatedAt $createdAt,
        ClientUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->dni = $dni;
        $this->dniType = $dniType;
        $this->clientType = $clientType;
        $this->clientCategory = $clientCategory;
        $this->frequentClientNumber = $frequentClientNumber;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        ClientId $id,
        ClientName $name,
        ClientLastname $lastname,
        ClientDni $dni,
        ClientDniType $dniType,
        ClientClientType $clientType,
        ClientClientCategory $clientCategory,
        ClientFrequentClientNumber $frequentClientNumber,
        ClientState $state
    ): self
    {
        return new self(
            $id,
            $name,
            $lastname,
            $dni,
            $dniType,
            $clientType,
            $clientCategory,
            $frequentClientNumber,
            $state,
            new ClientCreatedAt(),
            new ClientUpdatedAt()
        );
    }

    public function id(): ClientId
    {
        return $this->id;
    }

    public function name(): ClientName
    {
        return $this->name;
    }

    public function lastname(): ClientLastname
    {
        return $this->lastname;
    }

    public function dni(): ClientDni
    {
        return $this->dni;
    }

    public function dniType(): ClientDniType
    {
        return $this->dniType;
    }

    public function clientType(): ClientClientType
    {
        return $this->clientType;
    }

    public function clientCategory(): ClientClientCategory
    {
        return $this->clientCategory;
    }

    public function frequentClientNumber(): ClientFrequentClientNumber
    {
        return $this->frequentClientNumber;
    }

    public function state(): ClientState
    {
        return $this->state;
    }

    public function CreatedAt(): ClientCreatedAt
    {
        return $this->createdAt;
    }

    public function UpdatedAt(): ClientUpdatedAt
    {
        return $this->updatedAt;
    }
}
