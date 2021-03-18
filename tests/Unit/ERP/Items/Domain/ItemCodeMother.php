<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Domain;

use Medine\ERP\Items\Domain\ValueObjects\ItemCode;
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
