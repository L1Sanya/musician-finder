<?php

namespace Database\Factories;

use App\Models\Announcement;
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

    protected static ?string $password;

    protected $model = User::class;

    public function definition()
    {
        $roles = ['candidate', 'employer'];
        $randomRole = $this->faker->randomElement($roles);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', $randomRole)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Присваиваем случайную роль к созданному пользователю
            $role = Role::inRandomOrder()->first();
            $user->update(['role_id' => $role->id]);
        });
    }
}
