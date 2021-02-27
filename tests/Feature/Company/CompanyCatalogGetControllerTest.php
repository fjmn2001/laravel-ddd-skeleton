<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class CompanyCatalogGetControllerTest extends TestCase
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
    public function it_should_get_the_company_catalogs()
    {
        $this->markTestSkipped('backlog');
//        Passport::actingAs(
//            User::factory()->create()
//        );
//        $response = $this->json('GET', '/api/company/catalogs');
//
//        $response->assertJson([
//            'states' => [
//                ['id' => 'active', 'title' => 'Activo']
//            ]
//        ]);
//        $response->assertStatus(200);
    }
}
