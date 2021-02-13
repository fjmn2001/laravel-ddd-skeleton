<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Application\Update;

final class PurchaseInvoiceUpdaterRequest
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
    private $items;

    public function __construct(
        string $id,
        string $providerId,
        string $paymentTerm,
        string $code,
        string $issueDate,
        string $accountsPayId,
        string $reference,
        string $state,
        string $observations,
        float $subtotal,
        float $discount,
        float $tax,
        float $total,
        string $companyId,
        array $items
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
        $this->items = $items;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function providerId(): string
    {
        return $this->providerId;
    }

    public function paymentTerm(): string
    {
        return $this->paymentTerm;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function issueDate(): string
    {
        return $this->issueDate;
    }

    public function accountsPayId(): string
    {
        return $this->accountsPayId;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function observations(): string
    {
        return $this->observations;
    }

    public function subtotal(): float
    {
        return $this->subtotal;
    }

    public function discount(): float
    {
        return $this->discount;
    }

    public function tax(): float
    {
        return $this->tax;
    }

    public function total(): float
    {
        return $this->total;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function items(): array
    {
        return $this->items;
    }
}
