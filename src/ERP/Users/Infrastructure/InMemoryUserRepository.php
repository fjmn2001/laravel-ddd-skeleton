<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;


use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class InMemoryUserRepository implements UserRepository
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function find(UserEmail $email): ?User
    {
        // TODO: Implement find() method.
    }

    public function update(User $user): void
    {
        // TODO: Implement update() method.
    }
}
