<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Company;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Company\Application\CompanyUpdater;
use Medine\ERP\Company\Application\CompanyUpdaterRequest;

final class CompanyPutController extends Controller
{
    private $updater;

    public function __construct(CompanyUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->updater)(new CompanyUpdaterRequest(
            $id,
            $request->name,
            $request->address,
            $request->state,
            $request->logo
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
