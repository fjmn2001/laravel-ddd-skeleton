<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Roles\Application\Update;

use Medine\ERP\Roles\Application\Update\RolUpdater;
use Medine\ERP\Roles\Application\Update\RolUpdaterRequest;
use Medine\ERP\Roles\Infrastructure\MySqlRolRepository;
use Medine\ERP\Roles\Domain\Service\RolNotExistsException;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class RolUpdaterTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_rolfinder_updater_exception()
    {
        $this->expectException(RolNotExistsException::class);

        $ROL_ID = Uuid::random();
        $NEW_NAME = 'new_name';

        $rolUpdater = new RolUpdater(new MySqlRolRepository());
        $rolUpdater->__invoke(new RolUpdaterRequest(
            $ROL_ID->value(),
            $NEW_NAME,
            'Testing',
            'no',
            'active'
        ));
    }
}
