<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;
use Medine\ERP\Users\Domain\PasswordReset;
use Medine\ERP\Users\Domain\PasswordResetRepository;

final class MySqlPasswordResetRepository extends MySqlRepository implements PasswordResetRepository
{

    public function save(PasswordReset $passwordReset): void
    {
        DB::table('password_resets')->insert([
            'email' => $passwordReset->email()->value(),
            'token' => $passwordReset->token(),
            'created_at' => $passwordReset->createdAt()->value()
        ]);
    }

    public function matching(Criteria $criteria)
    {
        $query = DB::table('password_resets');
        $query = (new MySqlPasswordResetFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map(function ($row) {
            return PasswordReset::fromPrimitive(
                $row->email,
                $row->token,
                $row->created_at
            );
        })->toArray();
    }
}
