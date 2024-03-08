<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Valoracion>
 */
class ValoracionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comentario' => $this->faker->sentence,
             'puntos' => $this->faker->numberBetween(1, 5),
             'fk_user_id' => User::all()->random()->users_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
