<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class ClientesGetController extends Controller
{
    public function __invoke()
    {
        return new JsonResponse([]);
    }

}
