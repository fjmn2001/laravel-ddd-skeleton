<?php
declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class UserRenamerPutControllerTest extends TestCase
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
    public function it_should_rename_an_existing_user()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $email = $this->faker->email;

        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name(),
            'email' => $email,
            'password' => $this->faker->password
        ]);

        $this->putJson('api/usersRename/' . $email, [
            'name' => $this->faker->name(),
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
