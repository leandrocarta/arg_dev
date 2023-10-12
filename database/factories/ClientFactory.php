<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'ciudad' => $this->faker->city,
            'id_provincia' => null, // Puedes definir la lógica adecuada aquí
            'id_pais' => null, // Puedes definir la lógica adecuada aquí
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Cambia esto por la lógica adecuada
            'id_user' => null, // Puedes definir la lógica adecuada aquí
            'verificado' => null, // Puedes definir la lógica adecuada aquí
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    /* public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }*/
}
