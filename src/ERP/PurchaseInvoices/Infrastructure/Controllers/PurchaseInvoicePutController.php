<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\PurchaseInvoices\Application\Create\PurchaseInvoiceCreator;
use Medine\ERP\PurchaseInvoices\Application\Create\PurchaseInvoiceCreatorRequest;
use Medine\ERP\PurchaseInvoices\Application\Update\PurchaseInvoiceUpdater;
use Medine\ERP\PurchaseInvoices\Application\Update\PurchaseInvoiceUpdaterRequest;

final class PurchaseInvoicePutController extends Controller
{
    private $updater;

    public function __construct(PurchaseInvoiceUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new PurchaseInvoiceUpdaterRequest(
            $id,
            $request->providerId,
            $request->paymentTerm,
            $request->code,
            $request->issueDate,
            $request->accountsPayId,
            $request->reference,
            $request->state,
            $request->observations,
            $request->subtotal,
            $request->discount,
            $request->tax,
            $request->total,
            $request->companyId,
            $request->items
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
