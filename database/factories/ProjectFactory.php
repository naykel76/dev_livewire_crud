<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{

    protected $images = ['naykel-400-001.png', 'naykel-400-002.png', 'naykel-400-003.png', 'naykel-400-004.png', 'naykel-400-005.png',];

    public function definition()
    {
        return [
            'title' => $this->faker->text(random_int(25, 80)),
            'description' => $this->faker->sentence(random_int(15, 50)),
            'status' => $this->faker->randomElement(['published', 'draft']),
            'image_name' => $this->faker->randomElement($this->images),
            'sort_order' => random_int(0, 5),
            'created_at' => Carbon::today()->subDays(rand(-365, 365)),
            'published_at' => Carbon::today()->subDays(rand(-365, 365)),
        ];
    }
}
