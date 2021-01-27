<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Company;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Medine\ERP\Company\Application\CompanyCreator;
use Medine\ERP\Company\Application\CompanyCreatorRequest;

final class CompanyPostController extends Controller
{
    private $creator;

    public function __construct(CompanyCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            ($this->creator)(new CompanyCreatorRequest(
                $request->input('id', ''),
                $request->input('name', ''),
                $request->input('status', ''),
                $request->input('logo', ''),
                (string)Auth::user()->id
            ));

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
