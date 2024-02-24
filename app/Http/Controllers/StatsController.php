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

    public function incrementStat(Request $request)
    {
        $data = [
            "message"=>null,
            "status"=>500,
        ];

        $stats = Stat::where('project_id',$request->project->id)->first();
        if(!$stats)
        {
            $data["status"] = 404;
            $data["message"] = "No se encuentran las estadisticas";
            return response()->json($data)->setStatusCode($data["status"]);
        }
        
        try
        {
            $stats->increment($request->type);
        } catch (\Throwable $th) {
            $data["message"] = "No se pudo modificar";
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $data["status"] = 200;
        $data["message"] = "Incremento exitoso";
        return response()->json($data)->setStatusCode($data["status"]);
    }

    public function getStats(string $search)
    {
        $data = [
            "status" => 500,
            "message" => null,
            "criterio"=>$search,
            "stats"=>[
                "views"=>null,
                "interactions"=>null
            ]
        ];

        $project_id = Project::where('slug',$search)->orWhere('id',$search)->value('id');// -.-
        if(!$project_id)
        {
            $data["status"] = 404;
            $data["message"] = "No se encuentra el proyecto";
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $stats = Stat::where("project_id",$project_id)->first();
        if(!$stats)
        {
            $data["status"] = 404;
            $data["message"] = "No se encuentra la estadistica";
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $data["status"] = 200;
        $data["message"] = "Aqui estan las estadisticas del proyecto";
        $data["stats"]["views"] = $stats->views;
        $data["stats"]["interactions"] = $stats->interactions;
        return response()->json($data)->setStatusCode($data["status"]);
    }

}
