<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Update;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
use Medine\ERP\Product\Application\Update\ProductUpdater;
use Medine\ERP\Product\Application\Update\UpdateProductRequest;
use Medine\ERP\Product\Infrastructure\MySqlProductRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Tests\Unit\ERP\Product\Infrastructure\InMemoryProductRepository;

final class ProductUpdaterTest extends TestCase
{
    use DatabaseTransactions;

    protected $creator;
    protected $updater;
    protected $faker;

    protected function setUp(): void
    {
        $this->creator = new ProductCreator(
            new MySqlProductRepository()
        );
        $this->updater = new ProductUpdater(
            new MySqlProductRepository()
        );
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_update_an_existing_product_and_return_null()
    {
        $UUID = Uuid::uuid4()->toString();

        ($this->creator)(new CreateProductRequest(
            $UUID,
            $this->faker->text(6),
            $this->faker->name,
            Uuid::uuid4()->toString(),
            $this->faker->realText(255),
            Uuid::uuid4()->toString()
        ));

        $new_category_id = Uuid::uuid4()->toString();
        $new_type_id = Uuid::uuid4()->toString();

        $response = ($this->updater)(new UpdateProductRequest(
            $UUID,
            $this->faker->text(6),
            'NAME TEST',
            $new_category_id,
            'TEST DESCRIPTION',
            $new_type_id,
            $this->faker->randomElement(['activo', 'inactivo'])
        ));

        $this->assertNull($response);
    }
}
