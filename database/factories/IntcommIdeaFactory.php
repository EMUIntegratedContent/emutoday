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
					'teaser' => $this->faker->text(50),
					'content' => $this->faker->sentences(3, true),
					'contributor_netid' => $this->faker->randomElement(['cpuzzuol', 'wkraft', 'dgiffor2', 'sshine', 'pvuccolo']),
					'contributor_first' => $this->faker->firstName,
					'contributor_last' => $this->faker->lastName,
					'admin_status' => $this->faker->randomElement(['New', 'Viewed', 'Not Considering', 'Considering', 'Done']),
					'archived' => $this->faker->boolean,
					'is_submitted' => $this->faker->boolean,
					'created_at' => $this->faker->dateTimeThisMonth,
					'updated_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
