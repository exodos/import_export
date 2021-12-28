<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_name'=>$this->faker->unique()->company,
            'vendor_tel'=>$this->faker->unique->phoneNumber,
            'vendor_email'=>$this->faker->unique->companyEmail,
            'vendor_address'=>$this->faker->address,
            'vendor_balance'=>$this->faker->randomFloat(),
            'vendor_account'=>$this->faker->sentence(1)
        ];
    }
}
