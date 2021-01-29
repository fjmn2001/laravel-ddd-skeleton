<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class RolesGetControllerTest extends TestCase
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
        $NAME = 'original_name';
        $DESCRIPTION = $this->faker->text(25);
        $SUPERUSER = 'yes';
        $COMPANY_ID = Uuid::uuid4()->toString();

        $this->postJson('/api/roles', [
            'id' => $ROL_ID,
            'name' => $NAME,
            'description' => $DESCRIPTION,
            'superuser' => $SUPERUSER,
            'company_id' => $COMPANY_ID,//TODO: Implement this line
        ]);

        $response = $this->json('GET', '/api/roles', [
            "page" => 1,
            'filters' => [
                ['field' => 'name', 'value' => $NAME]
            ]
        ]);

        $response->assertJson([[
            'id' => $ROL_ID,
            'name' => $NAME,
            'description' => $DESCRIPTION,
            'superuser' => $SUPERUSER,
            'status' => 'active'
        ]]);
        $response->assertStatus(200);
    }
}
