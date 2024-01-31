<?php

namespace App\Http\Controllers;

use App\Models\GeneralStat;
use Illuminate\Http\Request;

class GeneralStatsController extends Controller
{
    public static function newGeneralView():int
    {
        $stats = GeneralStat::first();
        return $stats->increment('visitas');
    }

    public static function newInteraction(string $column):int
    {
        $stats = GeneralStat::first();
        return $stats->increment($column);
    }

    public function restartStat(string $column):bool
    {
        $stats = GeneralStat::first();
        $stats->$column = 0;
        return $stats->save();
    }
}
