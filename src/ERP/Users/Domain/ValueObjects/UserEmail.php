<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\Exceptions\EmptyArgumentException;
use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class UserEmail extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

    private function notEmpty(string $value): void
    {
        if (empty($value))
            throw new EmptyArgumentException("User email can't be empty");
    }
}
