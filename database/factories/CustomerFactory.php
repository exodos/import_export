<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_name' => $this->faker->firstName,
            'customer_tel' => $this->faker->phoneNumber,
            'customer_email' => $this->faker->unique()->safeEmail,
            'customer_address' => $this->faker->address,
            'customer_account'=>$this->faker->sentence(1),
            'customer_group' => function () {
                return Group::inRandomOrder()->first()->group_name;
            }
        ];
    }
}
