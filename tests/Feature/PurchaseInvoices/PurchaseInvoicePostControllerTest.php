<?php

declare(strict_types=1);

namespace Tests\Feature\PurchaseInvoices;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class PurchaseInvoicePostControllerTest extends TestCase
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
    public function it_should_create_a_new_purchase_invoice()
    {
        Passport::actingAs(
            User::factory()->create()
        );
        $response = $this->postJson('/api/purchase_invoices', [
            'id' => Uuid::uuid4()->toString(),
            'provider_id' => Uuid::uuid4()->toString(),
            'payment_term' => 'cash',
            'code' => $this->faker->postcode,
            'issue date' => '25/10/2021',
            'accounts_pay_id' => Uuid::uuid4()->toString(),
            'reference' => $this->faker->text(15),
            'state' => 'to_be_approved',
            'observations' => $this->faker->text(255),
            'subtotal' => 100,
            'discount' => 10,
            'tax' => 6.30,
            'total' => 96.30,
            'company_id' => Uuid::uuid4()->toString(),
            'items' => [
                [
                    'category_id' => Uuid::uuid4()->toString(),
                    'item_id' => Uuid::uuid4()->toString(),
                    'quantity' => 1,
                    'unit_id' => Uuid::uuid4()->toString(),
                    'unit_price' => 100,
                    'subtotal' => 100,
                    'tax_id' => Uuid::uuid4()->toString(),
                    'discount rate' => 10,
                    'accounting_center_id' => Uuid::uuid4()->toString(),
                    'account_id' => Uuid::uuid4()->toString(),
                    'location_id' => Uuid::uuid4()->toString()
                ]
            ]
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function it_should_create_a_new__no_superuser_rol()
    {
        Passport::actingAs(
            User::factory()->create()
        );
        $response = $this->postJson('/api/roles', [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(25),
            'superuser' => 'no',
            'company_id' => Uuid::uuid4()->toString(),//TODO: Implement this line
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
