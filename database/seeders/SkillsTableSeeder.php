<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Resume;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::factory()->count(2)->create();
    }
}
