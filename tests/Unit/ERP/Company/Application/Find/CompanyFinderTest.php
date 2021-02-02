<?php


namespace Tests\Unit\ERP\Company\Application\Find;


use Medine\ERP\Company\Application\Find\CompanyFinder;
use Medine\ERP\Company\Application\Find\CompanyFinderRequest;
use Medine\ERP\Company\Domain\Service\CompanyNotExistsException;
use Tests\Unit\ERP\Company\Infrastructure\InMemoryCompanyRepository;
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
        $repository = new InMemoryCompanyRepository();

        $finder = new CompanyFinder(new \Medine\ERP\Company\Domain\Service\CompanyFinder(
            $repository
        ));

        ($finder)(new CompanyFinderRequest($ROL_ID->value()));

    }

}
