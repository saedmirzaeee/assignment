<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(0,100),
            'points' => $this->faker->numberBetween(0,100),
            'address' => $this->faker->address()
        ];
    }

    public function incorrectAge(){
        return [
            'id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'age' => $this->faker->name(),
            'points' => $this->faker->numberBetween(0,100),
            'address' => $this->faker->address()
        ];
    }

    public function incorrectPoint(){
        return [
            'id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(0,10),
            'points' => $this->faker->numberBetween(-10,-1),
            'address' => $this->faker->address()
        ];
    }

}
