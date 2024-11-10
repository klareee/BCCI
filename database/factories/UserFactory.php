<?php

namespace Database\Factories;

use App\Enums\CivilStatusEnum;
use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('1234'),
            'remember_token' => Str::random(10),
            'date_of_birth' => now()->subYears(5),
            'gender' => Arr::random([GenderEnum::MALE, GenderEnum::FEMALE]),
            'address' => fake()->address(),
            'marital_status' => Arr::random([CivilStatusEnum::SINGLE, CivilStatusEnum::MARRIED]),
            'contact_number' => '09631853664',
        ];
    }

    public function admin() : static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', RoleEnum::ADMIN)->first()?->id,
        ]);
    }
    public function hr() : static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', RoleEnum::HR)->first()?->id,
        ]);
    }
    public function employee() : static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', RoleEnum::EMPLOYEE)->first()?->id,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
