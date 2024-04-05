<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Announcement;
use App\Models\Resume;
use App\Models\Role;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $instruments = ['piano', 'guitar', 'violin', 'limba', 'iochin'];

        foreach ($instruments as $instrument) {
            Skill::create([
                'name' => $instrument,
            ]);
        }

        $this->call([
            Role::create(['name' => 'candidate']),
            Role::create(['name' => 'employer']),
            User::factory()->count(10)->create(),
            Announcement::factory()->count(20)->create(),
            Resume::factory()->count(15)->create(),
        ]);
    }
}
