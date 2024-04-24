<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class MainController extends Controller
{
    public function main(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('main');
    }

    public function contact(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('contacts');
    }

    public function ogonek(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('ogonek');
    }
}
