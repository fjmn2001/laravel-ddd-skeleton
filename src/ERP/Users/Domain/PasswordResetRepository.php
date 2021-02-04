<?php


namespace Medine\ERP\Users\Domain;


use Medine\ERP\Shared\Domain\Criteria;

interface PasswordResetRepository
{
    public function save(PasswordReset $passwordReset): void;

    public function matching(Criteria $criteria);

    public function delete(Criteria $criteria): void;
}
