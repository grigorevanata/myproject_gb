<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->jobTitle();
        return [
            'category_id' => 3,
            'title' => $title,
            'slug' => str::slug(title),
            'author' => $this->faker->userName(),
            'image' => $this->faker->imageUrl(),
            'status' => 'ACTIVE',
            'description' => $this->faker->text(100),
            'only_admin' => false
        ];
    }
}
