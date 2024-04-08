<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['Piano', 'Guitar', 'Violin', 'Ukulele', 'Cello', 'Flute', 'Drums']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
