<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class ClientTypeOptionsGetController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $data = ' data-id="' . $id . '" ';
        $html = '';
        $html .= '<button class="btn btn-block  my-3 btn-modal edit" ' . $data . '>Ver tipo</button>';
        $html .= '<button class="btn btn-block  my-3 btn-modal changeState" ' . $data . '>Cambiar estado</button>';

        return new JsonResponse($html, JsonResponse::HTTP_OK);
    }

}
