<?php


namespace Tests\Feature\Provider;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ProviderGetControllerTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * @test
     */
    public function it_shuould_return_a_right_provider()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $ID = Uuid::uuid4()->toString();
        $NAME = 'NAME';

        $this->post('/api/provider',[
            'id' => $ID,
            'name' => $NAME
        ]);

        $respont = $this->get('/api/provider/'.$ID );
//dd($respont->getContent());
        $respont->assertJson([
            'id' => $ID,
            'name' => $NAME
        ]);
        $respont->assertStatus(200);
    }
}
