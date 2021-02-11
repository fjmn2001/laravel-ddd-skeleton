<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\PurchaseInvoices\Application\Find\PurchaseInvoiceFinder;
use Medine\ERP\PurchaseInvoices\Application\Find\PurchaseInvoiceFinderRequest;

final class PurchaseInvoiceGetController extends Controller
{
    private $finder;

    public function __construct(PurchaseInvoiceFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $purchaseInvoice = ($this->finder)(new PurchaseInvoiceFinderRequest(
            $id
        ));

        return new JsonResponse([
            'id' => $purchaseInvoice->id(),
            'providerId' => $purchaseInvoice->providerId(),
            'paymentTerm' => $purchaseInvoice->paymentTerm(),
            'code' => $purchaseInvoice->code(),
            'issueDate' => (new \DateTimeImmutable($purchaseInvoice->issueDate()))->format('d/m/Y'),
            'accountsPayId' => $purchaseInvoice->accountsPayId(),
            'reference' => $purchaseInvoice->reference(),
            'observations' => $purchaseInvoice->observations(),
            'subtotal' => $purchaseInvoice->subtotal(),
            'discount' => $purchaseInvoice->discount(),
            'tax' => $purchaseInvoice->tax(),
            'total' => $purchaseInvoice->total(),
            'companyId' => $purchaseInvoice->companyId(),
            'items' => $purchaseInvoice->items()
        ], JsonResponse::HTTP_OK);
    }
}
