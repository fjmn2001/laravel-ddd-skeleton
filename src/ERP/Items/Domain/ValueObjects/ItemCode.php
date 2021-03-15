<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class ItemCode extends StringValueObject
{
    const MAX_CODE_LENGTH = 6;
    private $exceptionMessage = "The item code can't be empty";
    private $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

    private function ensureLengthIsLessThanMaxCodeLenght(string $value): void
    {
        if (strlen($value) > self::MAX_CODE_LENGTH)
            throw new ProductCodeExceedMaxLength("The item code {$value} exceed the maximum length of " . self::MAX_CODE_LENGTH);
    }
}
