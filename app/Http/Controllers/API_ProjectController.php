<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Project;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class API_ProjectController extends Controller
{

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


    public function store(Request $request)
    {
        $data = [
            "status"=> 500,
            "message"=>null,            
        ];

        $validator = Validator::make($request->all(), [
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
    
        if ($validator->fails()) {
            $data["errors"] = $validator->errors();
            $data["status"] = 422;
            $data["message"] = "Hay errores en los datos ingresados";
            return response()->json($data, $data["status"]);
        }       

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

        $project->makeHidden(['visible','order']);

        $data = [
            "criterio"=>$search,
            "message"=>"Busqueda exitosa",
            "resultado"=>[
                "proyecto"=>$project,
            ]
        ];
       
        return response()->json($data)->setStatusCode(200);
    }


    public function update(Request $request)
    {
        $search = $request->search;
        $data = [
            "status"=>500,
            "message"=>"No se pudo modificar el proyecto",
        ];

        $original = Project::where('id',$search)->orWhere('slug',$search)->first();

        if(!$original)
        {
            $data["status"] = 404;
            $data["message"] = "No se encontró el proyecto";
            $data["criterio"] = $request->search;
            return response()->json($data)->setStatusCode($data["status"]);
        }

        $validator = Validator::make($request->all(), [
            'img'=>['sometimes','nullable','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['sometimes','nullable','min:3','string'],
            'description'=>['sometimes','nullable','min:3','string'],
            'slug'=>['sometimes','nullable','min:3','unique:projects,slug,' . $original->id,'regex:/^[a-zA-Z\-]+$/'],
            'github'=>['sometimes','nullable','url'],
            'web'=>['sometimes','nullable','url'],
            'tags'=>['sometimes','nullable','string', 'regex:/^[a-zA-Z0-9,]+$/'],
            'order'=>['nullable','sometimes','numeric','min:1','max:100'],
            'visible'=>['nullable','sometimes','boolean'],  
        ]);
    
        if ($validator->fails()) {
            $data["errors"] = $validator->errors();
            $data["status"] = 422;
            $data["message"] = "Hay errores en los datos ingresados";
            return response()->json($data, $data["status"]);
        } 

        $nuevo = new Project();
        $nuevo->title = $request->title ? $request->title : $original->title;
        $nuevo->description = $request->description ? $request->description : $original->description;
        $nuevo->slug = $request->slug ? $request->slug : $original->slug;
        $nuevo->github = $request->github ? $request->github : $original->github;
        $nuevo->web = $request->web ? $request->web : $original->web;
        $nuevo->tags = $request->tags ? $request->tags : $original->tags;
        $nuevo->order = $request->order ? $request->order : $original->order;
        $nuevo->visible = $request->visible ? $request->visible : $original->visible;


        $newImage = $this->editImage($request,$original,$nuevo);        
        if($newImage == false)
        {
            $data["status"] = 500;
            $data["message"] = "Ocurrio un error al procesar el cambio de imagen";
            return response()->json($data, $data["status"]);
        }

        $nuevo->image = $newImage;

        $original->fill($nuevo->toArray());
        $success = $original->save();

        $data["status"] = $success == true ? 200:500;
        $data["message"] = $success == true ? "Proyecto actualizado correctamente" : "No se pudo actualizar el proyecto";

        return response()->json($data, $data["status"]);
    }

    //Soy conciente de que esa funcion es media criminal, por lo que voy a comentarla para que pueda entender su funcionamiento en un futuro.
    //En resumen lo que hace es verificar si se otorga una archivo de imagen al request, en caso de contener uno elimina la imagen del proyecto original y guarda una nueva con
    //el slug nuevo que ingresó el usuario, en caso de que no se brinde un slug se dejara la imagen con el slug anterior.
    //Ahora, si no recibe una imagen sólo va a renombrar la ya existente con el slug nuevo o el slug viejo (dependiendo si el usuario envió uno nuevo o no).
    private function editImage(Request $request, Project $original, Project $nuevo) : string | bool
    {
        $newImage = null;
        //Si se recibe una imagen:
        if($request->img != null) 
        {
            //Elimino la anterior.
            unlink(public_path('img/').$original->image);
            //Y ahora guardo la nueva imagen. Si el usuario no provee un nuevo slug al proyecto, se colocará el ya existente (original).
            //En caso contrario (dónde el user SI quiere cambiar el slug y lo provee), se le colocará ese nuevo slug a la imagen.
            $newImage = $this->saveImage($request->file('img'),$nuevo->slug == null ? $original->slug : $nuevo->slug);            
        }
        else //Si el usuario no quiere editar la imagen, por ende, no envia ningún archivo:
        {            
            //Obtengo la extension de la imagen original (aunque siempre va a ser jpg, pero bueno).
            $extension = pathinfo(public_path('img/').$original->image,PATHINFO_EXTENSION);

            //Guardo en una variable el slug nuevo que ingresó el usuario, en caso de que el usuario no edite el slug entonces va a mantener el original.
            $slug = $nuevo->slug ? $nuevo->slug : $original->slug;
            
            //Renombro la imagen con el slug nuevo u original según corresponda.
            if(rename(public_path('img/').$original->image, public_path('img/projects/').$slug.'.'.$extension))
            {
                $newImage = 'projects/'.$slug.'.'.$extension;
            }
            else //Si hay algun al renombrar retorno 'false', para poder verificarlo en la funcion padre.
            {                
                return false;
            }            
        }
        //Retorno la nueva ruta de la imagen.
        return $newImage;
    }


    public function destroy(string $search)
    {
        $data = [            
            "status"=>500,
            "message"=>"No se pudo eliminar el proyecto",
        ];

        $project = Project::where('id',$search)->orWhere('slug',$search)->first();        

        if(!$project)
        {
            $data["status"] = 404;
            $data["message"]="No se encontró el proyecto: ".$search;    
            return response()->json($data)->setStatusCode($data["status"]);
        }
        
        if(unlink(public_path('img/').$project->image) && $project->delete())
        {
            $data["status"] = 200;
            $data["message"]="Proyecto eliminado";   
        }

        return response()->json($data)->setStatusCode($data["status"]);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    //Esto debería estar en el controlador de c/u, no es buena práctica esto    
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
