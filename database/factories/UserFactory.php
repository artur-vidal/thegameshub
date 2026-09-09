<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->firstName() . ' ' . fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->userName(),
            'password' => static::$password ??= Hash::make('senha'),
        ];
    }

    /**
     * The model represents an administrator user.
     */
    public function administrator(): static
    {
        return $this->state(fn(array $attributes) => [
            'admin' => true,
        ]);
    }
}
