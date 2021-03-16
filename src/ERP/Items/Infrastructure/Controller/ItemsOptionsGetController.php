<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;

final class ItemsOptionsGetController
{
    public function __invoke(string $id)
    {
        $data = ' data-id="' . $id . '" ';
        $html = '';
        $html .= '<button class="btn btn-block  my-3 btn-modal edit" ' . $data . '>Ver ítem</button>';
        $html .= '<button class="btn btn-block  my-3 btn-modal changeState" ' . $data . '>Cambiar estado</button>';

        return new JsonResponse($html, JsonResponse::HTTP_OK);
    }
}
