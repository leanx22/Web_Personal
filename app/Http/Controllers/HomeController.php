<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        $projects = Project::where('visible', 1)->get();
        $odd = count($projects) % 2 == 0 ? true:false;
        return view('index',['projects'=>$projects, 'odd'=>$odd]);
    }
}
