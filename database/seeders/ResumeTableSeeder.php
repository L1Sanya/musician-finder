<?php

namespace Database\Seeders;

use App\Models\Resume;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResumeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Resume::factory()->count(15)->create();
    }
}
