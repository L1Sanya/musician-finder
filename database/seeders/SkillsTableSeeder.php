<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    public function run()
    {
        Skill::create(['name' => 'Piano']);
        Skill::create(['name' => 'Violin']);
        Skill::create(['name' => 'Drums']);
        Skill::create(['name' => 'Guitar']);
        Skill::create(['name' => 'Cello']);
        Skill::create(['name' => 'Harmonica']);
        Skill::create(['name' => 'Flute']);
    }
}
