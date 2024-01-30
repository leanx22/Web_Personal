<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Stat;

class StatsController extends Controller
{
    public function restartAll(int $statID)
    {
        $stat = Stat::where('id',$statID)->first();
        if($stat == null)
        {
            return 'No existe esa estadistica';            
        }

        $stat->interactions = 0;
        $stat->views = 0;
        return $stat->save();
    }
}
