<?php

namespace App\Http\Controllers;

use App\Models\GeneralStat;
use Illuminate\Http\Request;

class GeneralStatsController extends Controller
{
    public static function newGeneralView():int
    {
        $stats = GeneralStat::first();
        if($stats == null)
        {
            $stats = new GeneralStat();
            $stats->save();
        }
        return $stats->increment('visitas');
    }

    public static function newInteraction(Request $request)
    {
        $stats = GeneralStat::first();
        $status = $stats->increment($request->interaction);

        $response = response()->json(["success"=>$status]);
        $response->setStatusCode($status == 1? 200 : 500);
        return $response;
    }

    public function restartStat(string $column):bool
    {
        $stats = GeneralStat::first();
        $stats->$column = 0;
        return $stats->save();
    }
}
