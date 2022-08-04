<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Emutoday\StoryIdea;
use Emutoday\User;
use Emutoday\StoryIdeaMedium;

class StoryIdeaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoryIdea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'assignee' => User::all()->random()->id,
            'creator' => User::all()->random()->id,
            'medium' => StoryIdeaMedium::all()->random()->id,
            'is_completed' => 0,
            'deadline' => $this->faker->dateTimeThisMonth,
            'idea' => $this->faker->sentences(3, true),
        ];
    }
}
