<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain;

use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceAccountsPayId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceCode;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceCompanyId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceDiscount;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceIssueDate;
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
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceObservations;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoicePaymentTerm;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceProviderId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceReference;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceState;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceSubtotal;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceTax;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceTotal;
use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;

final class PurchaseInvoice
{
    private $id;
    private $providerId;
    private $paymentTerm;
    private $code;
    private $issueDate;
    private $accountsPayId;
    private $reference;
    private $state;
    private $observations;
    private $subtotal;
    private $discount;
    private $tax;
    private $total;
    private $companyId;
    private $createdAt;
    private $updatedAt;
    private $items;

    public function __construct(
        PurchaseInvoiceId $id,
        PurchaseInvoiceProviderId $providerId,
        PurchaseInvoicePaymentTerm $paymentTerm,
        PurchaseInvoiceCode $code,
        PurchaseInvoiceIssueDate $issueDate,
        PurchaseInvoiceAccountsPayId $accountsPayId,
        PurchaseInvoiceReference $reference,
        PurchaseInvoiceState $state,
        PurchaseInvoiceObservations $observations,
        PurchaseInvoiceSubtotal $subtotal,
        PurchaseInvoiceDiscount $discount,
        PurchaseInvoiceTax $tax,
        PurchaseInvoiceTotal $total,
        PurchaseInvoiceCompanyId $companyId,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $updatedAt
    )
    {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->paymentTerm = $paymentTerm;
        $this->code = $code;
        $this->issueDate = $issueDate;
        $this->accountsPayId = $accountsPayId;
        $this->reference = $reference;
        $this->state = $state;
        $this->observations = $observations;
        $this->subtotal = $subtotal;
        $this->discount = $discount;
        $this->tax = $tax;
        $this->total = $total;
        $this->companyId = $companyId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        PurchaseInvoiceId $id,
        PurchaseInvoiceProviderId $providerId,
        PurchaseInvoicePaymentTerm $paymentTerm,
        PurchaseInvoiceCode $code,
        PurchaseInvoiceIssueDate $issueDate,
        PurchaseInvoiceAccountsPayId $accountsPayId,
        PurchaseInvoiceReference $reference,
        PurchaseInvoiceObservations $observations,
        PurchaseInvoiceSubtotal $subtotal,
        PurchaseInvoiceDiscount $discount,
        PurchaseInvoiceTax $tax,
        PurchaseInvoiceTotal $total,
        PurchaseInvoiceCompanyId $companyId
    ): self
    {
        return new self(
            $id,
            $providerId,
            $paymentTerm,
            $code,
            $issueDate,
            $accountsPayId,
            $reference,
            new PurchaseInvoiceState('to_be_approved'),
            $observations,
            $subtotal,
            $discount,
            $tax,
            $total,
            $companyId,
            DateTimeValueObject::now(),
            DateTimeValueObject::now()
        );
    }

    public static function fromDatabase(
        PurchaseInvoiceId $id,
        PurchaseInvoiceProviderId $providerId,
        PurchaseInvoicePaymentTerm $paymentTerm,
        PurchaseInvoiceCode $code,
        PurchaseInvoiceIssueDate $issueDate,
        PurchaseInvoiceAccountsPayId $accountsPayId,
        PurchaseInvoiceReference $reference,
        PurchaseInvoiceState $state,
        PurchaseInvoiceObservations $observations,
        PurchaseInvoiceSubtotal $subtotal,
        PurchaseInvoiceDiscount $discount,
        PurchaseInvoiceTax $tax,
        PurchaseInvoiceTotal $total,
        PurchaseInvoiceCompanyId $companyId,
        DateTimeValueObject $createdAt,
        DateTimeValueObject $updatedAt
    ): self
    {
        return new self(
            $id,
            $providerId,
            $paymentTerm,
            $code,
            $issueDate,
            $accountsPayId,
            $reference,
            $state,
            $observations,
            $subtotal,
            $discount,
            $tax,
            $total,
            $companyId,
            $createdAt,
            $updatedAt
        );
    }

    public function addPurchaseInvoiceItem(
        string $id,
        string $categoryId,
        string $itemId,
        float $quantity,
        string $unitId,
        float $unitPrice,
        float $subtotal,
        string $taxId,
        float $discountRate,
        string $accountingCenterId,
        string $accountId,
        string $locationId,
        PurchaseInvoiceId $purchaseInvoiceId
    ): void
    {
        $this->items[] = PurchaseInvoiceItem::create(
            new PurchaseInvoiceItemId($id),
            new PurchaseInvoiceItemCategoryId($categoryId),
            new PurchaseInvoiceItemItemId($itemId),
            new PurchaseInvoiceItemQuantity($quantity),
            new PurchaseInvoiceItemUnitId($unitId),
            new PurchaseInvoiceItemUnitPrice($unitPrice),
            new PurchaseInvoiceItemSubtotal($subtotal),
            new PurchaseInvoiceItemTaxId($taxId),
            new PurchaseInvoiceItemDiscountRate($discountRate),
            new PurchaseInvoiceItemAccountingCenterId($accountingCenterId),
            new PurchaseInvoiceItemAccountId($accountId),
            new PurchaseInvoiceItemLocationId($locationId),
            $purchaseInvoiceId
        );
    }

    public function id(): PurchaseInvoiceId
    {
        return $this->id;
    }

    public function providerId(): PurchaseInvoiceProviderId
    {
        return $this->providerId;
    }

    public function paymentTerm(): PurchaseInvoicePaymentTerm
    {
        return $this->paymentTerm;
    }

    public function code(): PurchaseInvoiceCode
    {
        return $this->code;
    }

    public function issueDate(): PurchaseInvoiceIssueDate
    {
        return $this->issueDate;
    }

    public function accountsPayId(): PurchaseInvoiceAccountsPayId
    {
        return $this->accountsPayId;
    }

    public function reference(): PurchaseInvoiceReference
    {
        return $this->reference;
    }

    public function state(): PurchaseInvoiceState
    {
        return $this->state;
    }

    public function observations(): PurchaseInvoiceObservations
    {
        return $this->observations;
    }

    public function subtotal(): PurchaseInvoiceSubtotal
    {
        return $this->subtotal;
    }

    public function discount(): PurchaseInvoiceDiscount
    {
        return $this->discount;
    }

    public function tax(): PurchaseInvoiceTax
    {
        return $this->tax;
    }

    public function total(): PurchaseInvoiceTotal
    {
        return $this->total;
    }

    public function companyId(): PurchaseInvoiceCompanyId
    {
        return $this->companyId;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeValueObject
    {
        return $this->updatedAt;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function changeProviderId(PurchaseInvoiceProviderId $providerId)
    {
        if (false === ($this->providerId()->equals($providerId))) {
            $this->providerId = $providerId;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changePaymentTerm(PurchaseInvoicePaymentTerm $paymentTerm)
    {
        if (false === ($this->paymentTerm()->equals($paymentTerm))) {
            $this->paymentTerm = $paymentTerm;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeCode(PurchaseInvoiceCode $code)
    {
        if (false === ($this->code()->equals($code))) {
            $this->code = $code;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeIssueDate(PurchaseInvoiceIssueDate $issueDate)
    {
        if (false === ($this->issueDate()->equals($issueDate))) {
            $this->issueDate = $issueDate;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeAccountsPayId(PurchaseInvoiceAccountsPayId $accountsPayId)
    {
        if (false === ($this->accountsPayId()->equals($accountsPayId))) {
            $this->accountsPayId = $accountsPayId;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeReference(PurchaseInvoiceReference $reference)
    {
        if (false === ($this->reference()->equals($reference))) {
            $this->reference = $reference;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeObservations(PurchaseInvoiceObservations $observations)
    {
        if (false === ($this->observations()->equals($observations))) {
            $this->observations = $observations;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeSubtotal(PurchaseInvoiceSubtotal $subtotal)
    {
        if (false === ($this->subtotal()->equals($subtotal))) {
            $this->subtotal = $subtotal;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeDiscount(PurchaseInvoiceDiscount $discount)
    {
        if (false === ($this->discount()->equals($discount))) {
            $this->discount = $discount;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeTax(PurchaseInvoiceTax $tax)
    {
        if (false === ($this->tax()->equals($tax))) {
            $this->tax = $tax;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }

    public function changeTotal(PurchaseInvoiceTotal $total)
    {
        if (false === ($this->total()->equals($total))) {
            $this->total = $total;
            $this->updatedAt = DateTimeValueObject::now();
        }
    }
}
