<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain;

use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class PasswordReset
{
    private $email;
    private $token;
    private $createdAt;

    private function __construct(
        UserEmail $email,
        string $token,
        DateTimeValueObject $createdAt
    )
    {
        $this->email = $email;
        $this->token = $token;
        $this->createdAt = $createdAt;
    }

    public static function create(UserEmail $param, string $token): self
    {
        return new self($param, $token, DateTimeValueObject::now());
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function createdAt(): DateTimeValueObject
    {
        return $this->createdAt;
    }
}
