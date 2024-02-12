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
    /**
     * Display a listing of the resource.
     * Get all public projects.
     */
    public function index() //Si estoy autenticado deberia poder ver los proyectos privados
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img'=>['required','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','unique:projects','regex:/^[a-zA-Z\-]+$/'],
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'tags'=>['required','string', 'regex:/^[a-zA-Z0-9,]+$/'],
            'order'=>['numeric','min:1','max:100'],
            'visible'=>['nullable','boolean'],            
        ]);
        
        $data = [
            "status"=> 500,
            "message"=>null,            
        ];

        $project = new Project();
        $project->title = $request->title;
        $project->slug = $request->slug;
        $project->description = $request->description;
        $project->tags = $request->tags;
        $project->visible = $request->visible == null ? false:$request->visible;
        $project->order = $request->order;
        
        $imageURL = $this->saveImage($request->file('img'),$request->slug);
        if(!$imageURL)
        {
            $data["message"] = "Ocurrió un error al procesar la imagen.";
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $project->image = $imageURL;
        
        if(!$project->save())
        {
            $data["message"] = "Ocurrió un error al intentar crear el proyecto.";
            return response()->json($data)->setStatusCode($data["status"]);
        }   

        $createdProject = Project::where('slug',$request->slug)->first();

        $stats = new Stat();
        $stats->project_id = $createdProject->id;

        $link = new Link();
        $link->github = $request->github != null ? $request->github : null;
        $link->web = $request->web != null ? $request->web : null;
        $link->project_id = $createdProject->id;

       
        if(!$stats->save() || !$link->save())
        {
            $createdProject->delete();
            $stats->delete();
            $link->delete();
            $data["message"] = "Ocurrió un error al intentar crear los registros hermanos";
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $data["status"] = 201;
        $data["message"] = "Proyecto guardado.";
        return response()->json($data)->setStatusCode($data["status"]);
    }

    private function saveImage($image, string $slug):bool|string
    {
        if($image == null || $slug == null)
        {
            return false;
        }

        $imgURL = "projects/".$slug.".".$image->clientExtension();        
        try
        {
            $image->move(public_path('img/projects/'),$imgURL);
            return $imgURL;
        } 
        catch (\Exception $ex)
        {
            return false;
        }                  
    }

    /**
     * Display the specified resource.
     * Get project data.
     */
    public function show(string $search) //Si estoy autenticado debería porder ver los proyectos privados
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $search)
    {
        $data = [            
            "status"=>500,    
            "criterio"=>$search,
            "message"=>null,
        ];

        $project = Project::where('id',$search)->orWhere('slug',$search)->first();        

        if(!$project)
        {
            $data["status"] = 404;
            $data["message"]="No se encontró el proyecto";    
            return response()->json($data)->setStatusCode($data["status"]);
        }
        
        $oldData = $project;
        $imageURL = $oldData->image;
        
        $request->validate([
            'img'=>['nullable','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','unique:projects,slug,' . $project->id,'regex:/^[a-zA-Z\-]+$/'],
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'tags'=>'regex:/^[a-zA-Z0-9,]+$/',
            'order'=>['numeric','min:1','max:100'],
            'visible'=>['nullable','boolean'],             
        ]);

        if($request->img != null)
        {
            unlink(public_path('img/').$oldData->image);
            $imageURL = $this->saveImage($request->file('img'),$request->slug);            
        }
        else
        {            
            //Cambio el nombre a la imagen ya existente por el nuevo slug ingresado.
            $extension = pathinfo(public_path('img/').$oldData->image,PATHINFO_EXTENSION);
            if(rename(public_path('img/').$oldData->image, public_path('img/projects/').$request->slug.'.'.$extension))
            {
                $imageURL = 'projects/'.$request->slug.'.'.$extension;
            }
            else //Si hay algun error
            {
                $data["status"] = 500;
                $data["message"]="No se pudo procesar la imagen";    
                return response()->json($data)->setStatusCode($data["status"]);
            }            
        }

        $success = $project->update([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'image'=>$imageURL,            
            'tags'=>$request->tags,
            'order'=>$request->order,
            'visible'=>$request->visible == null ? false:$request->visible,
        ]);

        //no debería estar aca, hacerlo por separado en su controlador
        $links = Link::where('project_id',$project->id)->first();
        $links->github = $request->github;
        $links->web = $request->web;
        $links->save();
        
        $data["status"] = 200;
        $data["message"]="Proyecto actualizado";    
        return response()->json($data)->setStatusCode($data["status"]);
        return redirect()->route('proyectos.index',['success'=>$success]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::where('id',$id)->first();
        unlink(public_path('img/').$project->image);
        $success = $project->delete();
        return redirect()->route('proyectos.index',['success'=>$success]);
    }


    //Esto debería estar en el controlador de c/u, no es buena práctica esto
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
