<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resume>
 */
class ResumeFactory extends Factory
{
    protected $model = Resume::class;

    public function definition()
    {
        // Создаем пользователя с ролью "candidate"
        $user = User::factory()->candidate()->create();

        return [
            'user_id' => $user->id,
            'experience' => $this->faker->sentence(),
            'info' => $this->faker->paragraphs(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Resume $resume) {
            $existingSkills = Skill::all(); // Получаем все существующие скиллы
            $randomSkills = $existingSkills->random(rand(1, 3)); // Выбираем случайные существующие скиллы

            $resume->skills()->attach($randomSkills->pluck('id')); // Привязываем выбранные скиллы к резюме
        });
    }
}
