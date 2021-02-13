<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Creator;


final class ClientCreatorRequest
{

    private $id;
    private $name;
    private $lastmane;
    private $dni;
    private $dni_type;
    private $client_type;
    private $client_category;
    private $frequent_client_number;
    private $state;
    private $phones;
    private $emails;

    public function __construct(
        string $id,
        string $name,
        string $lastmane,
        string $dni,
        string $dni_type,
        string $client_type,
        string $client_category,
        string $frequent_client_number,
        string $state,
        array $phones,
        array $emails
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastmane = $lastmane;
        $this->dni = $dni;
        $this->dni_type = $dni_type;
        $this->client_type = $client_type;
        $this->client_category = $client_category;
        $this->frequent_client_number = $frequent_client_number;
        $this->state = $state;
        $this->phones = $phones;
        $this->emails = $emails;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastmane(): string
    {
        return $this->lastmane;
    }

    public function dni(): string
    {
        return $this->dni;
    }

    public function dniType(): string
    {
        return $this->dni_type;
    }

    public function clientType(): string
    {
        return $this->client_type;
    }

    public function clientCategory(): string
    {
        return $this->client_category;
    }

    public function frequentClientNumber(): string
    {
        return $this->frequent_client_number;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function phones(): array
    {
        return $this->phones;
    }

    public function emails(): array
    {
        return $this->emails;
    }
}
