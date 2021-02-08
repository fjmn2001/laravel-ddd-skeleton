<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\PurchaseInvoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\PurchaseInvoices\Application\Create\PurchaseInvoiceCreator;
use Medine\ERP\PurchaseInvoices\Application\Create\PurchaseInvoiceCreatorRequest;

final class PurchaseInvoicePostController extends Controller
{
    private $creator;

    public function __construct(PurchaseInvoiceCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        ($this->creator)(new PurchaseInvoiceCreatorRequest(
            $request->id,
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

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
