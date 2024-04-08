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
        // Создаем пользователя с ролью "employer"
        $user = User::factory()->employer()->create();

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'creator_id' => $user->id,
            'location' => $this->faker->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Announcement $announcement) {
            $existingSkills = Skill::all(); // Получаем все существующие скиллы
            $randomSkills = $existingSkills->random(rand(1, 3)); // Выбираем случайные существующие скиллы

            $announcement->skills()->attach($randomSkills->pluck('id')); // Привязываем выбранные скиллы к резюме
        });
    }
}
