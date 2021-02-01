<?php


namespace Tests\Unit\ERP\Company\Application\Find;


use Medine\ERP\Company\Domain\Service\CompanyNotExistsException;
use Tests\Unit\ExampleTest;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;

class CompanyFinderTest extends ExampleTest
{

    /**
     * @test
     */
    public function it_should_not_find_a_company_not_registered()
    {
        $this->expectException(CompanyNotExistsException::class);
        $ROL_ID = Uuid::random();
        $repository = new InMemoryRolRepository();

        $finder = new RolFinder(new \Medine\ERP\Roles\Domain\Service\RolFinder(
            $repository
        ));

        ($finder)(new RolFinderRequest($ROL_ID->value()));

    }

}
