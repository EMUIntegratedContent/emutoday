<?php

namespace Database\Factories;

use Emutoday\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Emutoday\IntcommIdea>
 */
class IntcommIdeaFactory extends Factory
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
					'submitted_by' => $this->faker->asciify('********'),
					'status' => $this->faker->randomElement(['Draft', 'Submitted']),
					'created_at' => $this->faker->dateTimeThisMonth,
					'updated_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
