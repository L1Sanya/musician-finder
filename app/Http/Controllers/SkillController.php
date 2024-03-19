<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function skill()
    {
        return view('skill');
    }

    public function create(Request $request)
    {
        $data = $request->all();

        Skill::create([
            'skill_name' => $data['skill_name']
            ]);

        return redirect("/skill")->withSuccess('You have created the skill');
    }


}
