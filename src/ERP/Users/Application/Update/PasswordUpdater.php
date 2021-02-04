<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use Medine\ERP\Users\Domain\PasswordResetRepository;
use Medine\ERP\Users\Domain\Service\UserFinder;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;
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
            //todo: implement this throw exception
        }

        $user = ($this->userFinder)(new UserEmail($request->email()));


////Hash and update the new password
//    $user->password = \Hash::make($password);
//    $user->update(); //or $user->save();
//
//    //login the user immediately they change password successfully
//    Auth::login($user);
//
//    //Delete the token
//    DB::table('password_resets')->where('email', $user->email)
//        ->delete();
//

        $this->userRepository->save($user);
    }
}
