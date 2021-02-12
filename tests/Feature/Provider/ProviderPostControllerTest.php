<?php


namespace Tests\Feature\Provider;


use App\Models\User;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ProviderPostControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_new_provider_test()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $PROVIDER_id = Uuid::uuid4()->toString();
        $PROVIDER_name = 'TestName';

       $respost = $this->postJson('/api/provider', [
            'id' => $PROVIDER_id,
            'name' => $PROVIDER_name,
        ]);

       $respost->assertJson([]);
       $respost->assertStatus(201);
    }
}
