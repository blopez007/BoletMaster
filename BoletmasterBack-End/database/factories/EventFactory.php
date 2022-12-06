<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition()
    {
        return [
            'titulo'      => $this->faker->word,
            'descripcion' => $this->faker->text,
            'fecha_hora'  => $this->faker->dateTimeBetween('now', '+1 years'),
            'lugar'       => $this->faker->word,
            'imagen'      => $this->faker->imageUrl()
        ];
    }
}
