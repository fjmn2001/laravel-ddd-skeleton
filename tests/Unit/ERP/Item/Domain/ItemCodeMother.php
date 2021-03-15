<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Domain;

use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Tests\Unit\ERP\Shared\Domain\CodeMother;

final class ItemCodeMother
{
    public static function create(string $code): ItemCode
    {
        return new ItemCode($code);
    }

    public static function random(): ItemCode
    {
        return self::create(
            CodeMother::random()
        );
    }
}
