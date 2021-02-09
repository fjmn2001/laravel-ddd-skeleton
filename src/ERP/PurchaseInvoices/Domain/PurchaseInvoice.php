<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain;

use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceAccountsPayId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceCode;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceCompanyId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceDiscount;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceIssueDate;
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
}
