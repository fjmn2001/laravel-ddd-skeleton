<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Entity;


use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmail;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmailType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailId;

final class ClientHasEmail
{
    private $id;
    private $email;
    private $emailType;
    private $clientId;

    private function __construct(
        ClientHasEmailId $id,
        ClientHasEmailEmail $email,
        ClientHasEmailEmailType $emailType,
        ClientHasEmailClientId $clientId
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->emailType = $emailType;
        $this->clientId = $clientId;
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
            $clientId
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
        return $thisg->clientId;
    }
}
