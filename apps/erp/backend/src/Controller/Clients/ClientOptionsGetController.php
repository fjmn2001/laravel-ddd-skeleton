<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class ClientOptionsGetController extends Controller
{
    public function __invoke(string $id): JsonResponse
    {
        $data = ' data-id="' . $id . '" ';
        $html = '';
        $html .= '<button class="btn btn-block  my-3 btn-modal edit" ' . $data . '>Ver cliente</button>';
        $html .= '<button class="btn btn-block  my-3 btn-modal changeState" ' . $data . '>Cambiar estado</button>';

        return new JsonResponse($html, JsonResponse::HTTP_OK);
    }
}
