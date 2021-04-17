<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationSearcherResponse
{
    private $id;
    private $code;
    private $name;
    private $mainContact;
    private $barcode;
    private $address;
    private $state;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $mainContact,
        string $barcode,
        string $address,
        string $state
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->mainContact = $mainContact;
        $this->barcode = $barcode;
        $this->address = $address;
        $this->state = $state;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function mainContact(): string
    {
        return $this->mainContact;
    }

    public function barcode(): string
    {
        return $this->barcode;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function state(): string
    {
        return $this->state;
    }
}
