<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Bus\Event;

use App\Models\User;
use Medine\ERP\Users\Domain\PasswordResetCreatedDomainEvent;

final class SendEmailNotificationOnPasswordResetCreated implements DomainEventSubscriber
{

    public static function subscribedTo(): array
    {
        return [PasswordResetCreatedDomainEvent::class];
    }

    public function __invoke(PasswordResetCreatedDomainEvent $event): void
    {
        $eloquentUser = User::where('email', $event->email())->first();
        $eloquentUser->sendPasswordResetNotification($event->token());
    }
}
