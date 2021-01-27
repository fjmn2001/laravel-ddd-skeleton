<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;

final class MySqlUserRepository implements UserRepository
{

    public function save(User $user): void
    {
        DB::table('users')->insert([
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ]);
    }
}
