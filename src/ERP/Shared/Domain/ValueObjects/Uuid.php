<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\ValueObjects;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->ensureIsValidUuid($uuid);

        $this->uuid = $uuid;
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->uuid;
    }

    public function equals(self $newValue): bool
    {
        return $this->uuid === $newValue->value();
    }

    private function ensureIsValidUuid(string $uuid): void
    {
        if(!RamseyUuid::isValid($uuid)){
            throw new \Exception(sprintf("<%s> does not allow the value <%s>", static::class, $uuid));
        }
    }
}
