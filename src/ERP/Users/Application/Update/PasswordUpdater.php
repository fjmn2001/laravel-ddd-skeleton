<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

use Illuminate\Support\Facades\Hash;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use Medine\ERP\Users\Domain\PasswordResetRepository;
use Medine\ERP\Users\Domain\Service\UserFinder;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;
use Medine\ERP\Users\Domain\ValueObjects\UserPassword;
use function Lambdish\Phunctional\first;

final class PasswordUpdater
{
    private $passwordResetRepository;
    private $userFinder;
    private $userRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository, UserRepository $userRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userFinder = new UserFinder($userRepository);
        $this->userRepository = $userRepository;
    }

    public function __invoke(PasswordUpdaterRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues([
                ['field' => 'email', 'value' => $request->email()],
                ['field' => 'token', 'value' => $request->token()]
            ]),
            Order::fromValues('email', 'asc'),
            null,
            1
        );
        $passwordReset = first($this->passwordResetRepository->matching($criteria));

        if (null === $passwordReset) {
            throw new PasswordResetNotExistsException();
        }

        $user = ($this->userFinder)(new UserEmail($request->email()));

        $user->changePassword(
            new UserPassword(Hash::make($request->password()))
        );

        $criteria = new Criteria(
            Filters::fromValues([
                ['field' => 'email', 'value' => $request->email()]
            ]),
            Order::fromValues('email', 'asc'),
            null, null
        );

        $this->passwordResetRepository->delete($criteria);
        $this->userRepository->update($user);
    }
}
