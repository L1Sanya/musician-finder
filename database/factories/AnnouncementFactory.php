<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'creator_id' => function () {
                return User::factory()->create()->id;
            },
            'location' => $this->faker->city,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Announcement $announcement) {
            // Добавляем случайные навыки к созданному объявлению
            $skills = Skill::inRandomOrder()->limit(rand(1, 3))->get();
            $announcement->skills()->attach($skills);
        });
    }
}
