<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain;

use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

interface UserRepository
{
    public function save(User $user): void;

    public function find(UserEmail $email): ?User;

    public function update(User $user): void;
}
