<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Create;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
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
        $response = ($this->creator)(new CreateProductRequest(
            Uuid::uuid4()->toString(),
            $this->faker->text(6),
            $this->faker->name,
            Uuid::uuid4()->toString(),
            $this->faker->realText(255),
            Uuid::uuid4()->toString()
        ));

        $this->assertNull($response);
    }
}
