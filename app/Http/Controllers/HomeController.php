<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneralStatsController;
use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
}
