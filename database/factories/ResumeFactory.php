<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resume>
 */
class ResumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Resume::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'experience' => $this->faker->sentence(),
            'info' => $this->faker->paragraphs(3, true),
        ];
    }
}
