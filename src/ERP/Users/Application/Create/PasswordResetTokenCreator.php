<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Create;

use Medine\ERP\Users\Domain\PasswordReset;
use Medine\ERP\Users\Domain\PasswordResetRepository;
use Medine\ERP\Users\Domain\Service\UserFinder;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class PasswordResetTokenCreator
{
    private $repository;
    private $finder;

    public function __construct(PasswordResetRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->finder = new UserFinder($userRepository);
    }

    public function __invoke(PasswordResetTokenCreatorRequest $request)
    {
        $user = ($this->finder)(new UserEmail($request->email()));
        $passwordReset = PasswordReset::create(
            $user->email(),
            $request->token()
        );

        $this->repository->save($passwordReset);
        //todo: publish event PasswordResetCreated for send email

////Get the token just created above
//        $tokenData = DB::table('password_resets')
//            ->where('email', $request->email)->first();
//
//        if ($this->sendResetEmail($request->email, $tokenData->token)) {
//            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
//        } else {
//            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
//        }
    }

    private function sendResetEmail($email, $token)
    {
////Retrieve the user from the database
//        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
////Generate, the password reset link. The token generated is embedded in the link
//        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
//
//        try {
//            //Here send the link with CURL with an external email API
//            return true;
//        } catch (\Exception $e) {
//            return false;
//        }
    }
}
