<?php


namespace Tests\Feature\Provider;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ProviderPutControllerTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * @test
     */
    public function it_should_update_a_provider(){

        Passport::actingAs(
            User::factory()->create()
        );

        $PROVIDER_ID = Uuid::uuid4()->toString();
        $PROVIDER_NAME = 'TestName';
        $NEW_NAME = 'TestNewName';

        $this->postJson('/api/provider', [
            'id' => $PROVIDER_ID,
            'name' => $PROVIDER_NAME,
        ]);

        $respost = $this->putJson('/api/provider' . $PROVIDER_ID,
        [
            'name' => $NEW_NAME
        ]);

        $respost->assertJson([]);
        $respost->assertStatus(200);
    }

}
