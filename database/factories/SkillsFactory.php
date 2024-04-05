<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Role;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Skill::class;

    public function definition()
    {
        static $instruments;

        $instruments = $instruments ?: ['piano', 'guitar', 'violin', 'limba', 'iochin'];
        $instrument = $this->faker->unique()->randomElement($instruments);

        // Удаление инструмента из массива, чтобы он больше не мог быть выбран
        $key = array_search($instrument, $instruments);
        unset($instruments[$key]);

        return [
            'name' => $instrument,
        ];
    }

}
