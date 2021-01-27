<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Criteria;

final class FilterValue
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return json_encode($this->value());
    }
}
