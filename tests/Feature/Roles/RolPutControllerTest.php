<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class RolPutControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_update_an_existing_rol()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $ROL_ID = Uuid::uuid4()->toString();
        $ORIGINAL_NAME = 'original_name';
        $NEW_NAME = 'new_name';

        $this->postJson('/api/roles', [
            'id' => $ROL_ID,
            'name' => $ORIGINAL_NAME,
            'description' => $this->faker->text(25),
            'superuser' => 'yes',
            'company_id' => Uuid::uuid4()->toString(),//TODO: Implement this line
        ]);

        $response = $this->putJson('/api/roles/' . $ROL_ID, [
            'name' => $NEW_NAME,
            'description' => $this->faker->text(25),
            'superuser' => 'no',
            'status' => 'active'
        ]);

        $response->assertJson([]);
        $response->assertStatus(200);
    }
}
