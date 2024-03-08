<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeOption = ['provider', 'applicant'];
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'fk_user_id' => User::all()->random()->users_id,
            'type' => $this->faker->randomElement($typeOption),
            'created_at' => now(),
            'updated_at' => now(),     //
        ];
    }
}
