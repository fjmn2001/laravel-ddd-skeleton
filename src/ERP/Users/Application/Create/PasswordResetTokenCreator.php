<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Application\Create;

use Medine\ERP\Shared\Domain\Bus\Event\EventBus;
use Medine\ERP\Users\Domain\PasswordReset;
use Medine\ERP\Users\Domain\PasswordResetRepository;
use Medine\ERP\Users\Domain\Service\UserFinder;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class PasswordResetTokenCreator
{
    private $repository;
    private $finder;
    private $bus;

    public function __construct(PasswordResetRepository $repository, UserRepository $userRepository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->finder = new UserFinder($userRepository);
        $this->bus = $bus;
    }

    public function __invoke(PasswordResetTokenCreatorRequest $request)
    {
        $user = ($this->finder)(new UserEmail($request->email()));
        $passwordReset = PasswordReset::create(
            $user->email(),
            $request->token()
        );

        $this->repository->save($passwordReset);
        $this->bus->publish($passwordReset->pullDomainEvents());
    }
}
