<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

final class PasswordResetNotExistsException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The email and token combination is not valid.');
    }
}
