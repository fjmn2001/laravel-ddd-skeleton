<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Response;


use Medine\ERP\Clients\Domain\Entity\ClientHasEmail;
use Medine\ERP\Clients\Domain\Entity\ClientHasPhone;
use function Lambdish\Phunctional\map;

final class ClientResponse
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
    private $phones;
    private $emails;

    public function __construct(
        $id,
        $name,
        $lastname,
        $dni,
        $dniType,
        $clientType,
        $clientCategory,
        $frequentClientNumber,
        $state,
        $createdAt,
        $updatedAt,
        $phones,
        $emails
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
        $this->phones = $phones;
        $this->emails = $emails;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function dni()
    {
        return $this->dni;
    }

    public function dniType()
    {
        return $this->dniType;
    }

    public function clientType()
    {
        return $this->clientType;
    }

    public function clientCategory()
    {
        return $this->clientCategory;
    }

    public function frequentClientNumber()
    {
        return $this->frequentClientNumber;
    }

    public function state()
    {
        return $this->state;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

    public function updatedAt()
    {
        return $this->updatedAt;
    }

    public function phones()
    {
        if(empty($this->phones))
            return [];

        $phones = map($this->retrievePhone(), $this->phones);
        return $phones;
    }


    public function emails()
    {
        if(empty($this->emails))
            return [];

        $phones = map($this->retrieveEmail(), $this->emails);
        return $phones;
    }

    public function firstPhones()
    {
        if(empty($this->phones))
            return [];

        $phone =$this->phones[0];
        return [
            'id' => $phone->id()->value(),
            'number' => $phone->number()->value(),
            'numberType' => $phone->numberType()->value(),
            'client_id' => $phone->clientId()->value()
        ];
    }

    public function firstEmails()
    {
        if(empty($this->emails))
            return [];

        $email = $this->emails[0];
        return [
            'id' => $email->id()->value(),
            'email' => $email->email()->value(),
            'emailType' => $email->emailType()->value(),
            'client_id' => $email->clientId()->value()
        ];
    }


    private function retrieveEmail(): \Closure
    {
        return function (ClientHasEmail $email) {
            return [
                'id' => $email->id()->value(),
                'email' => $email->email()->value(),
                'emailType' => $email->emailType()->value(),
                'client_id' => $email->clientId()->value()
            ];
        };
    }

    private function retrievePhone(): \Closure
    {
        return function (ClientHasPhone $phone) {
            return [
                'id' => $phone->id()->value(),
                'number' => $phone->number()->value(),
                'numberType' => $phone->numberType()->value(),
                'client_id' => $phone->clientId()->value()
            ];
        };
    }
}
