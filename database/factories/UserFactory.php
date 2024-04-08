<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Resume;
use App\Models\Role;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $role = Role::where('name', $this->faker->randomElement(['candidate', 'employer']))->firstOrFail();

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('12341234'),
            'role_id' => $role->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function candidate()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::where('name', 'candidate')->first()->id,
            ];
        });
    }

    // Определяем пользовательский метод для создания пользователя с ролью "employer"
    public function employer()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::where('name', 'employer')->first()->id,
            ];
        });
    }
}
