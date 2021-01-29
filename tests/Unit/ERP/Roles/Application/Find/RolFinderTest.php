<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Roles\Application\Find;

use Medine\ERP\Roles\Application\Find\RolFinder;
use Medine\ERP\Roles\Application\Find\RolFinderRequest;
use Medine\ERP\Roles\Application\RolCreator;
use Medine\ERP\Roles\Application\RolCreatorRequest;
use Medine\ERP\Roles\Domain\Service\RolNotExistsException;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Roles\Infrastructure\InMemoryRolRepository;

final class RolFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_find_a_rol_registered()
    {
        $ROL_ID = Uuid::random();
        $COMPANY_ID = Uuid::random();
        $repository = new InMemoryRolRepository();
        $creator = new RolCreator($repository);
        ($creator)(new RolCreatorRequest(
            $ROL_ID->value(),
            'Testing',
            'Testing',
            'yes',
            $COMPANY_ID->value()
        ));

        $finder = new RolFinder(new \Medine\ERP\Roles\Domain\Service\RolFinder(
            $repository
        ));

        $rol = ($finder)(new RolFinderRequest($ROL_ID->value()));

        $this->assertEquals($rol->id(), $ROL_ID->value());
    }

    /**
     * @test
     */
    public function it_should_not_find_a_rol_not_registered()
    {
        $this->expectException(RolNotExistsException::class);
        $ROL_ID = Uuid::random();
        $repository = new InMemoryRolRepository();

        $finder = new RolFinder(new \Medine\ERP\Roles\Domain\Service\RolFinder(
            $repository
        ));

        ($finder)(new RolFinderRequest($ROL_ID->value()));
    }
}
