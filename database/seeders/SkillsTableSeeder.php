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
    public function run()
    {
        $instruments = ['piano', 'guitar', 'violin', 'limba', 'iochin'];

        foreach ($instruments as $instrument) {
            Skill::create([
                'name' => $instrument,
            ]);
        }
    }
}
