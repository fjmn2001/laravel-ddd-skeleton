<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Create;

final class PasswordResetTokenCreatorRequest
{
    private $email;
    private $token;

    public function __construct(
        string $email,
        string $token
    )
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function token(): string
    {
        return $this->token;
    }
}
