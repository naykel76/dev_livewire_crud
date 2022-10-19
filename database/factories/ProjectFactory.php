<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(random_int(25, 80)),
            'description' => $this->faker->sentence(random_int(15, 50)),
            'status' => $this->faker->randomElement(['published', 'draft', 'un-published']),
        ];
    }
}
