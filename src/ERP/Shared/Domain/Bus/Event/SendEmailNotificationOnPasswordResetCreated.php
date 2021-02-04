<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Bus\Event;

use Medine\ERP\Users\Domain\PasswordResetCreatedDomainEvent;

final class SendEmailNotificationOnPasswordResetCreated implements DomainEventSubscriber
{

    public static function subscribedTo(): array
    {
        return [PasswordResetCreatedDomainEvent::class];
    }

    public function __invoke(PasswordResetCreatedDomainEvent $event)
    {
        dd(
            $event,
            'TODO: SendEmailNotificationOnPasswordResetCreated'
        );
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
