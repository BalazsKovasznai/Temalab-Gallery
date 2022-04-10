<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Album;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->name,
            'photo'=>$this->faker->image,
            'size'=>$this->faker->numberBetween(1,20),
            'description'=>$this->faker->name,
            'album_id' => Album::factory()
        ];
    }
}
