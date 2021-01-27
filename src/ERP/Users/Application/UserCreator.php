<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application;

use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;
use Medine\ERP\Users\Domain\ValueObjects\UserName;
use Medine\ERP\Users\Domain\ValueObjects\UserPassword;

final class UserCreator
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserCreatorRequest $request)
    {
        $user = new User(
            new UserName($request->name()),
            new UserEmail($request->email()),
            new UserPassword($request->password())
        );
        $this->repository->save($user);
    }
}
