<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Criteria;

final class Filter
{
    private $field;
    private $value;

    public function __construct(FilterField $field, FilterValue $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public static function fromValues(array $values): self
    {
        return new self(
            new FilterField($values['field']),
            new FilterValue($values['value'])
        );
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }

    public function serialize(): string
    {
        return sprintf('%s.%s', $this->field->value(), $this->value->value());
    }
}
