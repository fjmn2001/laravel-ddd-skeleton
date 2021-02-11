<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Entity;


use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneCreateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumberType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneUpdateAt;

final class ClientHasPhone
{
    private $id;
    private $number;
    private $numberType;
    private $clientId;
    private $createAt;
    private $updateAt;

    private function __construct(
        ClientHasPhoneId $id,
        ClientHasPhoneNumber $number,
        ClientHasPhoneNumberType $numberType,
        ClientHasPhoneClientId $clientId,
        ClientHasPhoneCreateAt $createAt,
        ClientHasPhoneUpdateAt $updateAt
    )
    {
        $this->id = $id;
        $this->number = $number;
        $this->numberType = $numberType;
        $this->clientId = $clientId;
        $this->createAt = $createAt;
        $this->updateAt = $updateAt;
    }

    public static function create(
        ClientHasPhoneId $id,
        ClientHasPhoneNumber $number,
        ClientHasPhoneNumberType $numberType,
        ClientHasPhoneClientId $clientId
    ): self
    {
        return new self(
            $id,
            $number,
            $numberType,
            $clientId,
            new ClientHasPhoneCreateAt(),
            new ClientHasPhoneUpdateAt()
        );
    }

    public function id(): ClientHasPhoneId
    {
        return $this->id;
    }

    public function number(): ClientHasPhoneNumber
    {
        return $this->number;
    }

    public function numberType(): ClientHasPhoneNumberType
    {
        return $this->numberType;
    }

    public function clientId(): ClientHasPhoneClientId
    {
        return $this->clientId;
    }

    public function createdAt(): ClientHasPhoneCreateAt
    {
        return $this->createAt;
    }

    public function updatedAt(): ClientHasPhoneUpdateAt
    {
        return $this->updateAt;
    }
}
