<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    public function run()
    {
        Announcement::factory()->count(10)->create();
    }
}
