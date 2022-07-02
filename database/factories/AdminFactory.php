<?php

namespace Database\Factories;

use App\Enums\AdminRoles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            $customlocale = [$this->faker->addProvider(new \Faker\Provider\vi_VN\Person($this->faker)), $this->faker->addProvider(new \Faker\Provider\vi_VN\PhoneNumber($this->faker))];
            $name = $this->faker->lastName(). ' ' . $this->faker->middleName(). ' ' . $this->faker->firstName();
        return [
            'name' => $name,
            'gender' => $this->faker->boolean(),
            'date_of_birth' => $this->faker->dateTimeBetween($startDate = '-50 years', $endDate = '-18 years')->format("Y-m-d"),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => "1234",
            'role' => $this->faker->randomElement(AdminRoles::showValue()),
//            'email_activation' => now(),
//            'remember_token' => Str::random(10),
        ];
    }
}
