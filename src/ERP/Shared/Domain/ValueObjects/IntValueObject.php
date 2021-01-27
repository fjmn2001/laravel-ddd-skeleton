<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\ValueObjects;

class IntValueObject
{
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
