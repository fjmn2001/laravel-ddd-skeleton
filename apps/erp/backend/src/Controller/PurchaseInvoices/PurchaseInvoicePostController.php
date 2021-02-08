<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\PurchaseInvoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PurchaseInvoicePostController extends Controller
{
    public function __invoke(Request $request)
    {
        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
