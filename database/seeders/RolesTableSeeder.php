<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Создаем роль кандидата
        Role::create(['name' => 'candidate']);

        // Создаем роль работодателя
        Role::create(['name' => 'employer']);
    }
}
