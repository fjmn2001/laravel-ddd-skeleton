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
        ($this->creator)(new CompanyCreatorRequest(
            $request->id,
            $request->name,
            $request->address,
            $request->state,
            'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvuejs.org%2F&psig=AOvVaw2iwaicA5-fgsHJgOFWwde7&ust=1613311099724000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCPik6qyC5-4CFQAAAAAdAAAAABAD',
            (string)Auth::user()->id
        ));

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
