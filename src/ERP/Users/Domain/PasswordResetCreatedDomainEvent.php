<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain;

use Medine\ERP\Shared\Domain\Bus\Event\DomainEvent;

final class PasswordResetCreatedDomainEvent extends DomainEvent
{
    private $email;
    private $token;

    public function __construct(
        string $id,
        string $email,
        string $token,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);
        $this->email = $email;
        $this->token = $token;
    }

    public static function eventName(): string
    {
        return 'password_reset.created';
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self($aggregateId, $body['email'], $body['token'], $eventId, $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token
        ];
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
