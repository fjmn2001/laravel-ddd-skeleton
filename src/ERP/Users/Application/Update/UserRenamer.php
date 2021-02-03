<?php
declare(strict_types=1);

namespace Medine\ERP\Users\Application\Update;

use Medine\ERP\Users\Domain\Service\UserFinder;
use Medine\ERP\Users\Domain\UserRepository;
use Medine\ERP\Users\Domain\ValueObjects\UserEmail;

final class UserRenamer
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new UserFinder($repository);
    }

    public function __invoke(UserRenamerRequest $request): void
    {
        $user = ($this->finder)(new UserEmail($request->email()));


    }
}
