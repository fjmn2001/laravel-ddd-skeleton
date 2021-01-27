<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain\Service;

use Medine\ERP\Roles\Domain\ValueObjects\RolId;

final class RolNotExistsException extends \InvalidArgumentException
{

    public function __construct(RolId $id)
    {
        $message = "The rol with id: {$id->value()} do not exists.";
        parent::__construct($message);
    }
}
