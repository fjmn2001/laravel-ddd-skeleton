<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Find;

final class LocationFinderResponse
{
    private $id;
    private $code;
    private $name;
    private $mainContact;
    private $barcode;
    private $address;
    private $itemState;
    private $state;
    private $companyId;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $mainContact,
        string $barcode,
        string $address,
        string $itemState,
        string $state,
        string $companyId
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->mainContact = $mainContact;
        $this->barcode = $barcode;
        $this->address = $address;
        $this->itemState = $itemState;
        $this->state = $state;
        $this->companyId = $companyId;
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

    public function itemState(): string
    {
        return $this->itemState;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }
}
