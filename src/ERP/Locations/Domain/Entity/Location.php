<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Domain\Entity;

use Medine\ERP\Locations\Domain\ValueObject\LocationBarcode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCompanyId;
use Medine\ERP\Locations\Domain\ValueObject\LocationCreatedAt;
use Medine\ERP\Locations\Domain\ValueObject\LocationDirection;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;
use Medine\ERP\Locations\Domain\ValueObject\LocationItemState;
use Medine\ERP\Locations\Domain\ValueObject\LocationMainContact;
use Medine\ERP\Locations\Domain\ValueObject\LocationName;
use Medine\ERP\Locations\Domain\ValueObject\LocationState;
use Medine\ERP\Locations\Domain\ValueObject\LocationUpdatedAt;

final class Location
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
    private $createdAt;
    private $updatedAt;

    public function __construct(
        LocationId $id,
        LocationCode $code,
        LocationName $name,
        LocationMainContact $mainContact,
        LocationBarcode $barcode,
        LocationState $state,
        LocationDirection $direction,
        LocationCompanyId $companyId,
        LocationItemState $itemState,
        LocationCreatedAt $createdAt,
        LocationUpdatedAt $updatedAt
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
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        LocationId $id,
        LocationCode $code,
        LocationName $name,
        LocationMainContact $mainContact,
        LocationBarcode $barcode,
        LocationState $state,
        LocationDirection $direction,
        LocationCompanyId $companyId,
        LocationItemState $itemState
    ): self
    {
        return new self(
            $id,
            $code,
            $name,
            $mainContact,
            $barcode,
            new LocationState('to_be_approved'),
            $direction,
            $companyId,
            $itemState,
            new LocationCreatedAt(),
            new LocationUpdatedAt()
        );
    }

    public function id(): LocationId
    {
        return $this->id;
    }

    public function code(): LocationCode
    {
        return $this->code;
    }

    public function name(): LocationName
    {
        return $this->name;
    }

    public function mainContact(): LocationMainContact
    {
        return $this->mainContact;
    }

    public function barcode(): LocationBarcode
    {
        return $this->barcode;
    }

    public function state(): LocationState
    {
        return $this->state;
    }

    public function direction(): LocationDirection
    {
        return $this->direction;
    }

    public function companyId(): LocationCompanyId
    {
        return $this->companyId;
    }

    public function itemState(): LocationItemState
    {
        return $this->itemState;
    }
    public function createdAt(): LocationCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): LocationUpdatedAt
    {
        return $this->updatedAt;
    }
}
