<?php

namespace Database\Factories;

use Emutoday\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Emutoday\IntcommPost>
 */
class IntcommPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
					'title' => $this->faker->text(100),
					'teaser' => $this->faker->text(100),
					'content' => $this->faker->sentences(3, true),
					'start_date' => $this->faker->dateTimeThisMonth,
					'end_date' => $this->faker->dateTimeThisMonth,
					'submitted_by' => $this->faker->asciify('********'),
					'status' => $this->faker->randomElement(['Draft', 'Submitted', 'Approved', 'Denied']),
					'created_at' => $this->faker->dateTimeThisMonth,
					'updated_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
