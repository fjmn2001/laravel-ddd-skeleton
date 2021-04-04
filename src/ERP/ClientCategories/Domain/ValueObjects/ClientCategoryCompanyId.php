<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Domain\ValueObjects;


use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class ClientCategoryCompanyId extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
