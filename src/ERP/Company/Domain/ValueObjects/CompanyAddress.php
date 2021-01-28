<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class CompanyAddress extends StringValueObject
{
    protected $exceptionMessage = "Company address can't be empty";
    protected $exceptionCode = 404;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

}
