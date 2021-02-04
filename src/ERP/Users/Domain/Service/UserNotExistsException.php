<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain\Service;

use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class UserNotExistsException extends \InvalidArgumentException
{
    public function __construct(UserEmail $email)
    {
        $message = "The user {$email->value()} do not exists.";
        parent::__construct($message);
    }
}
