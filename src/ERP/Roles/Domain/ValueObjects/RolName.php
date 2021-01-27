<?php
declare(strict_types=1);

namespace Medine\ERP\Roles\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\Exceptions\EmptyArgumentException;
use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class RolName extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

    private function notEmpty(string $value): void
    {
        if (empty($value))
            throw new EmptyArgumentException("User name can't be empty");
    }
}
