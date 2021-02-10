<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Application\Find;

use Medine\ERP\PurchaseInvoices\Application\PurchaseInvoiceResponse;
use Medine\ERP\PurchaseInvoices\Domain\Service\PurchaseInvoiceFinder as Finder;
use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;

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
            []
        );
    }
}
