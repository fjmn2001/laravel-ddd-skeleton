<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Application\Response;

final class ClientCategoriesResponse
{
    private $clientCategory;

    public function __construct(ClientCategoryResponse ...$clientCategory)
    {
        $this->clientCategory = $clientCategory;
    }

    public function clientCategory(): array
    {
        return $this->clientCategory;
    }

}
