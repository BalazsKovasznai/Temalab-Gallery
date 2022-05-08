<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name'=>$this->faker->name,
            'description'=>$this->faker->name,
            'cover_image'=>$this->faker->image,

        ];
    }


    /**
     * Returns the relationship between an album and all users with whom
     * this album is shared.
     *
     * @return BelongsToMany
     */
    public function shared_with(): BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\User',
            'user_album',
            'album_id',
            'user_id'
        );
    }
}
