<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid4(),
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'status' => 'activo',
            'logo' => "coca-cola.jpg",
            ];
    }
}
