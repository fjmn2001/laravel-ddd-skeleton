<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Application\Find;

use Medine\ERP\PurchaseInvoices\Application\PurchaseInvoiceResponse;
use Medine\ERP\PurchaseInvoices\Domain\PurchaseInvoiceItem;
use Medine\ERP\PurchaseInvoices\Domain\Service\PurchaseInvoiceFinder as Finder;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;
use function Lambdish\Phunctional\map;

final class PurchaseInvoiceFinder
{
    private $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(PurchaseInvoiceFinderRequest $request)
    {
        $purchaseInvoice = ($this->finder)(new PurchaseInvoiceId($request->id()));

        return new PurchaseInvoiceResponse(
            $purchaseInvoice->id()->value(),
            $purchaseInvoice->providerId()->value(),
            $purchaseInvoice->paymentTerm()->value(),
            $purchaseInvoice->code()->value(),
            $purchaseInvoice->issueDate()->value(),
            $purchaseInvoice->accountsPayId()->value(),
            $purchaseInvoice->reference()->value(),
            $purchaseInvoice->observations()->value(),
            $purchaseInvoice->subtotal()->value(),
            $purchaseInvoice->discount()->value(),
            $purchaseInvoice->tax()->value(),
            $purchaseInvoice->total()->value(),
            $purchaseInvoice->companyId()->value(),
            map($this->retrieveItem(), $purchaseInvoice->items())
        );
    }

    private function retrieveItem(): \Closure
    {
        return function (PurchaseInvoiceItem $item) {
            return [
                'id' => $item->id()->value(),
                'categoryId' => $item->categoryId()->value(),
                'itemId' => $item->itemId()->value(),
                'quantity' => $item->quantity()->value(),
                'unitId' => $item->unitId()->value(),
                'unitPrice' => $item->unitPrice()->value(),
                'subtotal' => $item->subtotal()->value(),
                'taxId' => $item->taxId()->value(),
                'discountRate' => $item->discountRate()->value(),
                'accountingCenterId' => $item->accountingCenterId()->value(),
                'accountId' => $item->accountId()->value(),
                'locationId' => $item->locationId()->value()
            ];
        };
    }
}
