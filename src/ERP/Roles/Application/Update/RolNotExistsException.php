<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Update;

use http\Exception\InvalidArgumentException;

final class RolNotExistsException extends InvalidArgumentException
{

    public function __construct(string $id)
    {
        $message = "The rol with id: {$id} do not exists.";
        parent::__construct($message);
    }
}
