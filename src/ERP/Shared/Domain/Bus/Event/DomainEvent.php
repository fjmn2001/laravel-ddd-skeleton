<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Bus\Event;

use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;

abstract class DomainEvent
{
    private $aggregateId;
    private $eventId;
    private $occurredOn;

    public function __construct(string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        $this->aggregateId = $aggregateId;
        $this->eventId = $eventId ?: Uuid::random()->value();
        $this->occurredOn = $occurredOn ?: DateTimeValueObject::now()->value();
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    abstract public static function eventName(): string;

    abstract public function toPrimitives(): array;

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}
