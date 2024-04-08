<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Role;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'creator_id' => User::factory(),
            'location' => $this->faker->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
