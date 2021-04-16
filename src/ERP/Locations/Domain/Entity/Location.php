<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Domain\Entity;

use Medine\ERP\Locations\Domain\ValueObject\LocationBarcode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCompanyId;
use Medine\ERP\Locations\Domain\ValueObject\LocationCreatedAt;
use Medine\ERP\Locations\Domain\ValueObject\LocationAddress;
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
    private $address;
    private $itemState;
    private $state;
    private $companyId;
    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        LocationId $id,
        LocationCode $code,
        LocationName $name,
        LocationMainContact $mainContact,
        LocationBarcode $barcode,
        LocationAddress $address,
        LocationItemState $itemState,
        LocationState $state,
        LocationCompanyId $companyId,
        int $createdBy,
        int $updatedBy,
        LocationCreatedAt $createdAt,
        LocationUpdatedAt $updatedAt
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
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        string $id,
        string $code,
        string $name,
        string $mainContact,
        string $barcode,
        string $address,
        string $itemState,
        string $state,
        string $companyId,
        int $createdBy
    ): self
    {
        return new self(
            new LocationId($id),
            new LocationCode($code),
            new LocationName($name),
            new LocationMainContact($mainContact),
            new LocationBarcode($barcode),
            new LocationAddress($address),
            new LocationItemState($itemState),
            new LocationState($state),
            new LocationCompanyId($companyId),
            $createdBy,
            $createdBy,
            new LocationCreatedAt(),
            new LocationUpdatedAt()
        );
    }

    public static function fromValue(
        $id,
        $code,
        $name,
        $mainContact,
        $barcode,
        $address,
        $itemState,
        $state,
        $companyId,
        $createdBy,
        $updatedBy,
        $createdAt,
        $updatedAt
    ): self
    {
        return new self(
            new LocationId($id),
            new LocationCode($code),
            new LocationName($name),
            new LocationMainContact($mainContact),
            new LocationBarcode($barcode),
            new LocationAddress($address),
            new LocationItemState($itemState),
            new LocationState($state),
            new LocationCompanyId($companyId),
            $createdBy,
            $updatedBy,
            new LocationCreatedAt($createdAt),
            new LocationUpdatedAt($updatedAt)
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

    public function address(): LocationAddress
    {
        return $this->address;
    }

    public function companyId(): LocationCompanyId
    {
        return $this->companyId;
    }

    public function itemState(): LocationItemState
    {
        return $this->itemState;
    }

    public function createdBy(): int
    {
        return $this->createdBy;
    }

    public function updatedBy(): int
    {
        return $this->updatedBy;
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
