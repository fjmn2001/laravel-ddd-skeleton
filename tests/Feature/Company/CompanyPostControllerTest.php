<?php

declare(strict_types=1);


namespace Tests\Feature\Company;


use Faker\Factory;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class CompanyPostControllerTest extends TestCase
{
    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_new_company()
    {
        $response = $this->postJson('/api/company', [
            'id' => Uuid::uuid4(),
            'nombre' => $this->faker->name(),
            'direccion' => $this->faker->address,
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
