<?php

namespace Database\Factories;

use App\Models\AdsNets;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdsNetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdsNets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image' => null,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween($min = 1000, $max = 500000),
            'printing_price' => $this->faker->numberBetween($min = 1000, $max = 5000),
            'agency_price' => 20,
            'city_id' => $this->faker->numberBetween($min = 1, $max = 13),
            'company_id' => $this->faker->numberBetween($min = 1, $max = 4),
            'type_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'in_out' => $this->faker->numberBetween($min = 0, $max = 1),
            'is_video' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
