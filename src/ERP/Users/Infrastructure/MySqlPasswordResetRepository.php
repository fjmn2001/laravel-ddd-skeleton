<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Users\Domain\PasswordReset;

final class MySqlPasswordResetRepository implements \Medine\ERP\Users\Domain\PasswordResetRepository
{

    public function save(PasswordReset $passwordReset): void
    {
        DB::table('password_resets')->insert([
            'email' => $passwordReset->email()->value(),
            'token' => $passwordReset->token(),
            'created_at' => $passwordReset->createdAt()->value()
        ]);
    }
}
