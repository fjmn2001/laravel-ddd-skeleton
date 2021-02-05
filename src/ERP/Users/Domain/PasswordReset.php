<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain;

use Medine\ERP\Shared\Domain\Aggregate\AggregateRoot;
use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class PasswordReset extends AggregateRoot
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

    public static function create(UserEmail $email, string $token): self
    {
        $passwordReset = new self($email, $token, DateTimeValueObject::now());

        $passwordReset->record(new PasswordResetCreatedDomainEvent(
            Uuid::random()->value(),
            $email->value(),
            $token
        ));

        return $passwordReset;
    }

    public static function fromPrimitive(string $email, string $token, string $createdAt): self
    {
        return new self(new UserEmail($email), $token, new DateTimeValueObject($createdAt));
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
