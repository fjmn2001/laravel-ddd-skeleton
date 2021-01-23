<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserPostController extends Controller
{
    public function __invoke(Request $request)
    {
        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
