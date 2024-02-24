<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use Illuminate\Http\Request;

class API_projectLinkController extends Controller
{

    public function store(Request $request)
    {
        //
    }

    public function getLinksOfProject(string $search)
    {
        $data = [
            "message"=>null,
            "status"=>500,
            "links"=>[
                "github"=>null,
                "web"=>null,
            ]
        ];
        
        $project_info = Project::where('slug',$search)->select(['id','visible'])->first();        

        if(!$project_info || !$project_info['visible'])
        {
            $data["message"] = "No se encuentra el proyecto";
            $data["status"] = 404;
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $links = Link::where('project_id',$project_info["id"])->first();

        if(!$links)
        {
            $data["message"] = "No se encuentran los enlaces";
            $data["status"] = 404;
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $data["message"] = "Estas son los enlaces  del proyecto";
        $data["status"] = 200;
        $data["links"]["github"] = $links->github;
        $data["links"]["web"] = $links->web;
        return response()->json($data)->setStatusCode($data["status"]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
