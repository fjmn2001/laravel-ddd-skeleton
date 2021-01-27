<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\Exceptions\InvalidDateException;

class DateValueObject
{
    private $date;

    public function __construct(string $date)
    {
        $this->date = $this->setDate($date);
    }

    public function value(): string
    {
        return $this->date;
    }

    public function setDate(string $date): string
    {
        $explodedDate = explode('-', $date);

        if (!checkdate(
            (int)$explodedDate[1],
            (int)$explodedDate[2],
            (int)$explodedDate[0]
        ))
            throw new InvalidDateException('Given date is not accepted');

        return $date;
    }
}
