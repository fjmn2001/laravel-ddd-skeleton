<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Domain\Entity;

use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailCreateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmail;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmailType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailUpdateAt;

final class ClientHasEmail
{
    private $id;
    private $email;
    private $emailType;
    private $clientId;
    private $createAt;
    private $updateAt;

    private function __construct(
        ClientHasEmailId $id,
        ClientHasEmailEmail $email,
        ClientHasEmailEmailType $emailType,
        ClientHasEmailClientId $clientId,
        ClientHasEmailCreateAt $createAt,
        ClientHasEmailUpdateAt $updateAt
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->emailType = $emailType;
        $this->clientId = $clientId;
        $this->createAt = $createAt;
        $this->updateAt = $updateAt;
    }

    public static function create(
        ClientHasEmailId $id,
        ClientHasEmailEmail $email,
        ClientHasEmailEmailType $emailType,
        ClientHasEmailClientId $clientId
    ): self
    {
        return new self(
            $id,
            $email,
            $emailType,
            $clientId,
            new ClientHasEmailCreateAt(),
            new ClientHasEmailUpdateAt()
        );
    }

    public static function fromDatabase(
        ClientHasEmailId $id,
        ClientHasEmailEmail $email,
        ClientHasEmailEmailType $emailType,
        ClientHasEmailClientId $clientId,
        ClientHasEmailCreateAt $createAt,
        ClientHasEmailUpdateAt $updateAt
    ): self
    {
        return new self(
            $id,
            $email,
            $emailType,
            $clientId,
            $createAt,
            $updateAt
        );
    }

    public function id(): ClientHasEmailId
    {
        return $this->id;
    }

    public function email(): ClientHasEmailEmail
    {
        return $this->email;
    }

    public function emailType(): ClientHasEmailEmailType
    {
        return $this->emailType;
    }

    public function clientId(): ClientHasEmailClientId
    {
        return $this->clientId;
    }

    public function createdAt(): ClientHasEmailCreateAt
    {
        return $this->createAt;
    }

    public function updatedAt(): ClientHasEmailUpdateAt
    {
        return $this->updateAt;
    }
}
