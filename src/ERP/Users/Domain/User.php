<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain;

use Medine\ERP\Users\Domain\ValueObjects\UserEmail;
use Medine\ERP\Users\Domain\ValueObjects\UserName;
use Medine\ERP\Users\Domain\ValueObjects\UserPassword;

final class User
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        UserName $name,
        UserEmail $email,
        UserPassword $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromDatabase(
        UserName $name,
        UserEmail $email,
        UserPassword $password
    ): self
    {
        return new self($name, $email, $password);
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function changeName(UserName $newName): void
    {
        if (false === ($this->name()->equals($newName))) {
            $this->name = $newName;
        }
    }

    public function changePassword(UserPassword $newPassword)
    {
        if (false === ($this->password()->equals($newPassword))) {
            $this->password = $newPassword;
        }
    }
}
