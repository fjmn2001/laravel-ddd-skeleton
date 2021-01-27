<?php
declare(strict_types=1);

namespace Medine\ERP\Roles\Domain\ValueObjects;

use Medine\ERP\Shared\Domain\Exceptions\EmptyArgumentException;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;

final class RolCompanyId extends Uuid
{
    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }

    private function notEmpty(string $value): void
    {
        if (empty($value))
            throw new EmptyArgumentException("User company can't be empty");
    }
}
