<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Domain\Service;

use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class UserFinder
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserEmail $email): User
    {
        $user = $this->repository->find($email);

        if (null === $user) {
            throw new UserNotExistsException($email);
        }

        return $user;
    }
}
