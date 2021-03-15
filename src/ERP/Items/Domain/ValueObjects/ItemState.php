<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class ItemState extends StringValueObject
{
    private $exceptionMessage = "The item state can't be empty";
    private $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
