<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;


use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;

final class InMemoryUserRepository implements UserRepository
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
