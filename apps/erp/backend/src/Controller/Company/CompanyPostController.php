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
        $error = '';

        try {

            ($this->creator)( new CompanyCreatorRequest(
                $request->input('id', ''),
                $request->input('name', ''),
                $request->input('address', ''),
                $request->input('status', ''),
                $request->input('logo', '')
            ));

        }catch (\Exception $e) {
            $error = $e->getMessage();
        }

        $response = [
            "code" => strlen($error) ? JsonResponse::HTTP_UNAUTHORIZED : JsonResponse::HTTP_CREATED,
            "message" => strlen($error) ? $error : "Successfully created company"
        ];

        return response()->json($response, $response['code']);
    }
}
