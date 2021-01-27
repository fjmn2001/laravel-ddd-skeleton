<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\ValueObjects;

class StringValueObject
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }
}
