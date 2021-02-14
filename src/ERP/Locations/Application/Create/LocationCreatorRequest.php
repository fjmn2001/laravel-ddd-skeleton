<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Create;

final class LocationCreatorRequest
{
    private $id;
    private $code;
    private $name;
    private $mainContact;
    private $barcode;
    private $state;
    private $direction;
    private $companyId;
    private $itemState;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $mainContact,
        string $barcode,
        string $state,
        string $direction,
        string $companyId,
        string $itemState
    )
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->mainContact = $mainContact;
        $this->barcode = $barcode;
        $this->state = $state;
        $this->direction = $direction;
        $this->companyId = $companyId;
        $this->itemState = $itemState;
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

    public function state(): string
    {
        return $this->state;
    }

    public function direction(): string
    {
        return $this->direction;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function itemState(): string
    {
        return $this->itemState;
    }
}
