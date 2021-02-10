<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class ClientClientType extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
