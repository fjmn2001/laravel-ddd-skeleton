<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Application\Find;


final class ClientCategoryFinderRequest
{
    private $id;

    public function __construct(
        string $id
    )
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

}
