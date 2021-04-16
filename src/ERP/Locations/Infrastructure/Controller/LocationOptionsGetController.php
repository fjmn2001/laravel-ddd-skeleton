<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;

final class LocationOptionsGetController
{
    public function __invoke(string $id)
    {
        $data = ' data-id="' . $id . '" ';
        $html = '';
        $html .= '<button class="btn btn-block  my-3 btn-modal edit" ' . $data . '>Ver ubicación</button>';
        $html .= '<button class="btn btn-block  my-3 btn-modal changeState" ' . $data . '>Cambiar estado</button>';

        return new JsonResponse($html, JsonResponse::HTTP_OK);
    }
}
