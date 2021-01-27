<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\Exceptions\EmptyArgumentException;
use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class UserName extends StringValueObject
{
    protected $exceptionMessage = "User name can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

}
