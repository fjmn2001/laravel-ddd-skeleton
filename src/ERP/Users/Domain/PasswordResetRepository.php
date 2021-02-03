<?php


namespace Medine\ERP\Users\Domain;


interface PasswordResetRepository
{
    public function save(PasswordReset $passwordReset): void;
}
