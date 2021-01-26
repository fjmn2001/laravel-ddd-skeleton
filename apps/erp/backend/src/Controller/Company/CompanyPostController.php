<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Company;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                $request->input('nombre', ''),
                $request->input('direccion', '')
            ));

        }catch (\Exception $e) {
            $error = $e->getMessage();
        }

        $response = [
            "code" => strlen($error) ? JsonResponse::HTTP_UNAUTHORIZED : JsonResponse::HTTP_CREATED,
            "message" => strlen($error) ? $error : "Pelicula creada con exito"
        ];

        return response()->json($response, $response['code']);
    }
}
