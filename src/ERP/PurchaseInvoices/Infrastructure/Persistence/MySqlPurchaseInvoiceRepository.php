<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoice;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceItem;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceRepository;
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
