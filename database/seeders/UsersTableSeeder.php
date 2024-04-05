<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Создаем 10 пользователей
        $users = User::factory()->count(10)->create();

        // Для каждого созданного пользователя добавляем роли
        $users->each(function ($user) {
            $roles = Role::inRandomOrder()->limit(1)->get();
            $user->roles()->attach($roles->pluck('id')); // Присоединяем только идентификаторы ролей
        });
    }
}
