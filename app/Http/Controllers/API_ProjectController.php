<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use App\Models\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//borrar

class API_ProjectController extends Controller
{
    function getAllPublicProjects(Request $request)
    {
        $data = [
            "response" => 200,
            "message" => 'Listado de todos los proyectos.',
            "results" => [],
        ];
        
        $projects = Project::all();

        foreach($projects as $project)
        {
            if($project->visible)
            {
                $project->makeHidden(['visible']);
                $project->tags = explode(',',$project->tags);
                
                $links = Link::where('project_id',$project->id)->first();
                $stats = Stat::where('project_id',$project->id)->first();
                $project->links = ['github'=>$links->github,'web'=>$links->web];
                $project->stats = ['views'=>$stats->views,'interactions'=>$stats->interactions];
                array_push($data["results"],$project);
            }  
        }

        return response()->json($data)->setStatusCode(200);
    }

    function getProjectData(Request $request,$search)
    {
        $project = Project::where('id',$search)->orWhere('slug',$search)->first();        

        if(!$project || $project->visible == false)
        {
            $data = [                
                "criterio"=>$search,
                "message"=>$project ? "Proyecto privado":"No encontrado",
                "resultado"=>null
            ];
    
            return response()->json($data)->setStatusCode($project ? 403:404); //Por seguridad, siempre debería retornar 404.
        }

        $links = Link::where('project_id',$project->id)->first();
        $stats = Stat::where('project_id',$project->id)->first();

        $project->makeHidden(['visible']);

        $data = [
            "criterio"=>$search,
            "message"=>"Busqueda exitosa",
            "resultado"=>[
                "proyecto"=>$project,
                "enlaces"=>[
                    "github"=>$links->github,
                    "web"=>$links->web
                ],
                "estadisticas"=>[
                    "vistas"=>$stats->views,
                    "interacciones"=>$stats->interactions
                ]
            ]
        ];
       
        return response()->json($data)->setStatusCode(200);
    }

    function getLinksOfProject(Request $request, $search)
    {
        $project = Project::where('id',$search)->orWhere('slug',$search)->first();        

        $data = [
            "status"=>500,
            "criterio"=>$search,
            "message"=>null,
            "success"=>false,
            "results"=>null
        ];

        if(!$project || $project->visible == false)
        {
            $data["status"]=$project ? 403:404;
            $data["message"]=$project ? "Proyecto privado":"No encontrado";
    
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $links = Link::where('project_id',$project->id)->first();

        $data["status"]=200;
        $data["message"] = "Operacion exitosa";
        $data["results"] = ["github"=>$links->github,"web"=>$links->web,];

        return response()->json($data)->setStatusCode($data["status"]);

    }

    function getStatsOfProject(Request $request, $search)
    {
        $project = Project::where('id',$search)->orWhere('slug',$search)->first();        

        $data = [
            "status"=>500,
            "criterio"=>$search,
            "message"=>null,
            "success"=>false,
            "results"=>null
        ];

        if(!$project || $project->visible == false)
        {
            $data["status"]=$project ? 403:404;
            $data["message"]=$project ? "Proyecto privado":"No encontrado";
    
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $stats = Stat::where('project_id',$project->id)->first();

        $data["status"]=200;
        $data["message"] = "Operacion exitosa";
        $data["results"] = ["Visitas"=>$stats->views,"web"=>$stats->interactions,];

        return response()->json($data)->setStatusCode($data["status"]);

    }

    function changeProjectStat(Request $request)
    {
        $data = [
            "status"=>500,
            "criterio"=>$request->projectId,
            "message"=>null,
            "success"=>false,
            "rowsAffected"=>0,
        ];

        $rowsAffected = 0;

        $stat = Stat::where('project_id',$request->projectId)->first();
        
        if($stat)
        {
            try {
                $rowsAffected = $stat->increment($request->type);
            } catch (\Throwable $th) {
                
                $data["message"]= "No se pudo modificar la estadística en la base de datos";
                return response()->json($data)->setStatusCode(404);

            }
            
        }
        else
        {
            $data["status"] = 404;
            $data["message"] = "No se encontró la estadística";
    
            return response()->json($data)->setStatusCode(404);
        }
        
        $data["rowsAffected"] = $rowsAffected;
        $data["status"] = 200;
        $data["message"] = "Modificación exitosa";
        $data["successs"] = true;

        return response()->json($data)->setStatusCode($data["status"]);

    }
}
