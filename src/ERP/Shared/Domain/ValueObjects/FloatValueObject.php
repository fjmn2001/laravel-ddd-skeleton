<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\ValueObjects;

final class FloatValueObject
{
    private $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}
