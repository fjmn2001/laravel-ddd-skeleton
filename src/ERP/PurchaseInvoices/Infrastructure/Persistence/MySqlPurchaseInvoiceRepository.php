<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoice;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceItem;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceRepository;
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
use Medine\ERP\Shared\Infrastructure\MySqlRepository;
use function Lambdish\Phunctional\map;

final class MySqlPurchaseInvoiceRepository extends MySqlRepository implements PurchaseInvoiceRepository
{

    public function save(PurchaseInvoice $invoice): void
    {
        DB::table('purchase_invoices')->insert([
            'id' => $invoice->id()->value(),
            'provider_id' => $invoice->providerId()->value(),
            'payment_term' => $invoice->paymentTerm()->value(),
            'code' => $invoice->code()->value(),
            'issue_date' => $invoice->issueDate()->value(),
            'accounts_pay_id' => $invoice->accountsPayId()->value(),
            'reference' => $invoice->reference()->value(),
            'state' => $invoice->state()->value(),
            'observations' => $invoice->observations()->value(),
            'subtotal' => $invoice->subtotal()->value(),
            'discount' => $invoice->discount()->value(),
            'tax' => $invoice->tax()->value(),
            'total' => $invoice->total()->value(),
            'company_id' => $invoice->companyId()->value(),
            'created_at' => $invoice->createdAt()->value(),
            'updated_at' => $invoice->updatedAt()->value(),
        ]);

        $items = map($this->retrieveItem(), $invoice->items());
        DB::table('purchase_invoice_items')->insert($items);
    }

    public function find(PurchaseInvoiceId $id): ?PurchaseInvoice
    {
        $row = DB::table('purchase_invoices')->where('purchase_invoices.id', $id->value())->first();

        return !empty($row) ? PurchaseInvoice::fromDatabase(
            new PurchaseInvoiceId($row->id),
            new PurchaseInvoiceProviderId($row->provider_id),
            new PurchaseInvoicePaymentTerm($row->payment_term),
            new PurchaseInvoiceCode($row->code),
            new PurchaseInvoiceIssueDate($row->issue_date),
            new PurchaseInvoiceAccountsPayId($row->accounts_pay_id),
            new PurchaseInvoiceReference($row->reference),
            new PurchaseInvoiceState($row->state),
            new PurchaseInvoiceObservations($row->observations),
            new PurchaseInvoiceSubtotal($row->subtotal),
            new PurchaseInvoiceDiscount($row->discount),
            new PurchaseInvoiceTax($row->tax),
            new PurchaseInvoiceTotal($row->total),
            new PurchaseInvoiceCompanyId($row->company_id),
            new DateTimeValueObject($row->created_at),
            new DateTimeValueObject($row->updated_at)
        ) : null;
    }

    private function retrieveItem(): \Closure
    {
        return function (PurchaseInvoiceItem $item) {
            return [
                'id' => $item->id()->value(),
                'category_id' => $item->categoryId()->value(),
                'item_id' => $item->itemId()->value(),
                'quantity' => $item->quantity()->value(),
                'unit_id' => $item->unitId()->value(),
                'unit_price' => $item->unitPrice()->value(),
                'subtotal' => $item->subtotal()->value(),
                'tax_id' => $item->taxId()->value(),
                'discount_rate' => $item->discountRate()->value(),
                'accounting_center_id' => $item->accountingCenterId()->value(),
                'account_id' => $item->accountId()->value(),
                'location_id' => $item->locationId()->value(),
                'purchase_invoice_id' => $item->purchaseInvoiceId()->value(),
                'created_at' => $item->createdAt()->value(),
                'updated_at' => $item->updatedAt()->value()
            ];
        };
    }
}
