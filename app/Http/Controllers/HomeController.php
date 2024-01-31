<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneralStatsController;
use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        GeneralStatsController::newGeneralView();
        $projects = Project::where('visible', 1)->orderBy('order','asc')->get();
        $odd = count($projects) % 2 == 0 ? true:false;
        return view('index',['projects'=>$projects, 'odd'=>$odd]);
    }
}
