<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;
use Medine\ERP\Users\Domain\ValueObjects\UserName;
use Medine\ERP\Users\Domain\ValueObjects\UserPassword;

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

    public function find(UserEmail $email): ?User
    {
        $row = DB::table('users')->where('users.email', $email->value())->first();

        return !empty($row) ? User::fromDatabase(
            new UserName($row->name),
            new UserEmail($row->email),
            new UserPassword($row->password)
        ) : null;
    }
}
