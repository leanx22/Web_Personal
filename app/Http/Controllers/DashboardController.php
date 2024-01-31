<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralStat;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = GeneralStat::first();
        if($stats==null)
        {
            $stats = new GeneralStat();
            $stats->save();
        }
        return view('dashboard',['stats'=>$stats]);
    }
}
