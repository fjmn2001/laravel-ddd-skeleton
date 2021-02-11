<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain;

use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemAccountId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemAccountingCenterId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemCategoryId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemDiscountRate;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemItemId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemLocationId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemQuantity;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemSubtotal;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemTaxId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemUnitId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceItemUnitPrice;
use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;

final class PurchaseInvoiceItem
{
    private $id;
    private $categoryId;
    private $itemId;
    private $quantity;
    private $unitId;
    private $unitPrice;
    private $subtotal;
    private $taxId;
    private $discountRate;
    private $accountingCenterId;
    private $accountId;
    private $locationId;
    private $purchaseInvoiceId;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        PurchaseInvoiceItemId $id,
        PurchaseInvoiceItemCategoryId $categoryId,
        PurchaseInvoiceItemItemId $itemId,
        PurchaseInvoiceItemQuantity $quantity,
        PurchaseInvoiceItemUnitId $unitId,
        PurchaseInvoiceItemUnitPrice $unitPrice,
        PurchaseInvoiceItemSubtotal $subtotal,
        PurchaseInvoiceItemTaxId $taxId,
        PurchaseInvoiceItemDiscountRate $discountRate,
        PurchaseInvoiceItemAccountingCenterId $accountingCenterId,
        PurchaseInvoiceItemAccountId $accountId,
        PurchaseInvoiceItemLocationId $locationId,
        PurchaseInvoiceId $purchaseInvoiceId,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $updatedAt
    )
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
        $this->unitId = $unitId;
        $this->unitPrice = $unitPrice;
        $this->subtotal = $subtotal;
        $this->taxId = $taxId;
        $this->discountRate = $discountRate;
        $this->accountingCenterId = $accountingCenterId;
        $this->accountId = $accountId;
        $this->locationId = $locationId;
        $this->purchaseInvoiceId = $purchaseInvoiceId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        PurchaseInvoiceItemId $id,
        PurchaseInvoiceItemCategoryId $categoryId,
        PurchaseInvoiceItemItemId $itemId,
        PurchaseInvoiceItemQuantity $quantity,
        PurchaseInvoiceItemUnitId $unitId,
        PurchaseInvoiceItemUnitPrice $unitPrice,
        PurchaseInvoiceItemSubtotal $subtotal,
        PurchaseInvoiceItemTaxId $taxId,
        PurchaseInvoiceItemDiscountRate $discountRate,
        PurchaseInvoiceItemAccountingCenterId $accountingCenterId,
        PurchaseInvoiceItemAccountId $accountId,
        PurchaseInvoiceItemLocationId $locationId,
        PurchaseInvoiceId $purchaseInvoiceId
    ): self
    {
        return new self(
            $id,
            $categoryId,
            $itemId,
            $quantity,
            $unitId,
            $unitPrice,
            $subtotal,
            $taxId,
            $discountRate,
            $accountingCenterId,
            $accountId,
            $locationId,
            $purchaseInvoiceId,
            DateTimeValueObject::now(),
            DateTimeValueObject::now()
        );
    }

    public function id(): PurchaseInvoiceItemId
    {
        return $this->id;
    }

    public function categoryId(): PurchaseInvoiceItemCategoryId
    {
        return $this->categoryId;
    }

    public function itemId(): PurchaseInvoiceItemItemId
    {
        return $this->itemId;
    }

    public function quantity(): PurchaseInvoiceItemQuantity
    {
        return $this->quantity;
    }

    public function unitId(): PurchaseInvoiceItemUnitId
    {
        return $this->unitId;
    }

    public function unitPrice(): PurchaseInvoiceItemUnitPrice
    {
        return $this->unitPrice;
    }

    public function subtotal(): PurchaseInvoiceItemSubtotal
    {
        return $this->subtotal;
    }

    public function taxId(): PurchaseInvoiceItemTaxId
    {
        return $this->taxId;
    }

    public function discountRate(): PurchaseInvoiceItemDiscountRate
    {
        return $this->discountRate;
    }

    public function accountingCenterId(): PurchaseInvoiceItemAccountingCenterId
    {
        return $this->accountingCenterId;
    }

    public function accountId(): PurchaseInvoiceItemAccountId
    {
        return $this->accountId;
    }

    public function locationId(): PurchaseInvoiceItemLocationId
    {
        return $this->locationId;
    }

    public function purchaseInvoiceId(): PurchaseInvoiceId
    {
        return $this->purchaseInvoiceId;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }
}
