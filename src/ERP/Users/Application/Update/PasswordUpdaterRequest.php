<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

final class PasswordUpdaterRequest
{
    private $email;
    private $password;
    private $token;

    public function __construct(
        string $email,
        string $password,
        string $token
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function token(): string
    {
        return $this->token;
    }
}
