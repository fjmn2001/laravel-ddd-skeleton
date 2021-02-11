<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Domain\Entity;


use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumberType;

final class ClientHasPhone
{
    private $id;
    private $number;
    private $numberType;
    private $clientId;

    private function __construct(
        ClientHasPhoneId $id,
        ClientHasPhoneNumber $number,
        ClientHasPhoneNumberType $numberType,
        ClientHasPhoneClientId $clientId
    )
    {
        $this->id = $id;
        $this->number = $number;
        $this->numberType = $numberType;
        $this->clientId = $clientId;
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
            $clientId
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
}
