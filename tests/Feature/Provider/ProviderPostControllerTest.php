<?php


namespace Tests\Feature\Provider;


use App\Models\User;
use Laravel\Passport\Passport;
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

       $respost = $this->postJson('/api/provider', [
            'id' => '2020',
            'name' => 'Gabriel',
        ]);

       dd($respost->getContent());
        $respost->assertJson([]);
        $respost->assertStatus(201);
    }
}
