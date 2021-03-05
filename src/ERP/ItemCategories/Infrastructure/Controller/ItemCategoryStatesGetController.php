<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;

final class ItemCategoryStatesGetController
{
    public function __invoke(string $id)
    {
        $data = ' data-id="' . $id . '" ';
        $html = '';
        $html .= '<button class="btn btn-block  my-3 btn-outline-success" ' . $data . ' data-state="active">Active</button>';
        $html .= '<button class="btn btn-block  my-3 btn-outline-danger" ' . $data . ' data-state="inactive">Inactive</button>';

        return new JsonResponse($html, JsonResponse::HTTP_OK);
    }
}
