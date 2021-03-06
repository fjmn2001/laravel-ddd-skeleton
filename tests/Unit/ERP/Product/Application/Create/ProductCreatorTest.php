<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Create;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
use Medine\ERP\Shared\Domain\Exceptions\InvalidUuidException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Unit\ERP\Product\Infrastructure\InMemoryProductRepository;

final class ProductCreatorTest extends TestCase
{
    use DatabaseTransactions;

    protected $creator;
    protected $faker;

    protected function setUp(): void
    {
        $this->creator = new ProductCreator(
            new InMemoryProductRepository()
        );
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_valid_product_and_return_null()
    {
        $response = ($this->creator)(CreateProductRequestMother::random());

        $this->assertNull($response);
    }

    /**
     * @test
     */
    public function it_should_throw_invalid_uuid_exception()
    {
        $this->expectException(InvalidUuidException::class);

        $response = ($this->creator)(CreateProductRequestMother::withId('wrong'));

        $this->assertNull($response);
    }
}
