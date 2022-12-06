<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    public function definition()
    {
        return [
            'tipo_entrada' => $this->faker->word,
            'cantidad'     => $this->faker->numberBetween(1, 10),
            'precio'       => $this->faker->numberBetween(1, 10),
        ];
    }
}
