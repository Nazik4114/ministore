<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Specification>
 */
class SpecificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brands=[
            'Apple',
            'Samsung',
            'Xiaomi',
            'Poco',
        ];
        return [
            'key'=>'price',
            'value'=>$this->faker->numberBetween(100,10000),
        ];
    }
}
