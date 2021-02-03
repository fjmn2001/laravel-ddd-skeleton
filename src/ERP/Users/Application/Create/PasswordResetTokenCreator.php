<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Create;

final class PasswordResetTokenCreator
{
    public function __invoke(PasswordResetTokenCreatorRequest $request)
    {
//        //You can add validation login here
//        $user = DB::table('users')->where('email', '=', $request->email)
//            ->first();
////Check if the user exists
//        if (count($user) < 1) {
//            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
//        }
//
////Create Password Reset Token
//        DB::table('password_resets')->insert([
//            'email' => $request->email,
//            'token' => str_random(60),
//            'created_at' => Carbon::now()
//        ]);
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
