<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Medine\ERP\Users\Domain\User;

final class MySqlUserRepository implements \Medine\ERP\Users\Domain\UserRepository
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
