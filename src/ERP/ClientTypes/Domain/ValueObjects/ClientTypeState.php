<?php

declare(strict_types=1);


namespace Medine\ERP\ClientTypes\Domain\ValueObjects;


use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

final class ClientTypeState extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->notEmpty($value);
        parent::__construct($value);
    }
}
