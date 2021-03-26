<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Entity;


use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientCompanyId;
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
    private $companyId;
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

    private $phones;
    private $emails;

    private function __construct(
        ClientId $id,
        ClientCompanyId $companyId,
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
        $this->companyId = $companyId;
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
        ClientCompanyId $companyId,
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
            $companyId,
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

    public static function fromDatabase(
        ClientId $id,
        ClientCompanyId $companyId,
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
    ): self
    {
        return new self(
            $id,
            $companyId,
            $name,
            $lastname,
            $dni,
            $dniType,
            $clientType,
            $clientCategory,
            $frequentClientNumber,
            $state,
            $createdAt,
            $updatedAt
        );
    }

    public function id(): ClientId
    {
        return $this->id;
    }

    public function companyId(): ClientCompanyId
    {
        return $this->companyId;
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

    public function createdAt(): ClientCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ClientUpdatedAt
    {
        return $this->updatedAt;
    }

    public function phones(): ?array
    {
        return $this->phones;
    }

    public function emails(): ?array
    {
        return $this->emails;
    }

    public function addClientPhone(
        ClientHasPhone $phone
    ): void
    {
        $this->phones[] = $phone;
    }

    public function addClientEmail(
        ClientHasEmail $email
    ): void
    {
        $this->emails[] = $email;
    }

    public function changeName(ClientName $newName)
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function changeDniType(ClientDniType $newDniType)
    {
        if (false === ($this->dniType()->equals($newDniType))) {
            $this->dniType = $newDniType;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function changeClientType(ClientClientType $newClientType)
    {
        if (false === ($this->clientType()->equals($newClientType))) {
            $this->clientType = $newClientType;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function changeClientCategory(ClientClientCategory $newClientCategory)
    {
        if (false === ($this->clientCategory()->equals($newClientCategory))) {
            $this->clientCategory = $newClientCategory;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function changeFrequentClientNumbrer(ClientFrequentClientNumber $newFrequentClientNumber)
    {
        if (false === ($this->frequentClientNumber()->equals($newFrequentClientNumber))) {
            $this->frequentClientNumber = $newFrequentClientNumber;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function changeState(ClientState $newState)
    {
        if (false === ($this->state()->equals($newState))) {
            $this->state = $newState;
            $this->updatedAt = new ClientUpdatedAt();
        }
    }

    public function restartPhones()
    {
        $this->phones = [];
    }

    public function restartEmails()
    {
        $this->emails = [];
    }
}
