<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application;

final class UserCreatorRequest
{
    private $name;
    private $email;
    private $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
