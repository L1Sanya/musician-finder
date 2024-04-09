<?php

namespace Database\Seeders;

use App\Models\Resume;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResumesTableSeeder extends Seeder
{
    public function run()
    {
        Resume::factory()->count(10)->create();
    }
}
