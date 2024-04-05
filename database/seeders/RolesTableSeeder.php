<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'candidate']);
        Role::create(['name' => 'employer']);
    }
}
