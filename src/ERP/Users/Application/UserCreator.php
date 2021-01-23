<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application;

use Medine\ERP\Users\Domain\User;
use Medine\ERP\Users\Domain\UserRepository;

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
            $request->name(),
            $request->email(),
            $request->password()
        );
        $this->repository->save($user);
    }
}
