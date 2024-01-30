<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Stat;
use App\Models\Link;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('order','asc')->get();//Entiendo que se puede usar paginate, sin embargo, no voy a tener nunca tantos registros.
        $regs = count($projects);
        return view('projects.index',['projects'=>$projects, 'count'=>$regs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create',['title'=>'Nuevo proyecto', 'action'=>'Crear proyecto']);
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
            'slug'=>['required','min:3','unique:projects','regex:/^[a-zA-Z\-]+$/'], //tengo que validar que no contenga espacios y solo letras+guiones medios
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'tags'=>['required','string', 'regex:/^[a-zA-Z0-9,]+$/'],
            'visible'=>['nullable','boolean'],            
        ]);
        
        $project = new Project();
        $project->title = $request->title;
        $project->slug = $request->slug;
        $imageURL = $this->saveImage($request); 
        $project->image = $imageURL == false ? 'projects/extra/no_image.jpg' : $imageURL;
        $project->description = $request->description;
        $project->tags = $request->tags;
        $project->visible = $request->visible == null ? false:$request->visible;
        //$project->order = $request->order;
        $project->save();
        
        $createdProject = Project::where('slug',$request->slug)->first();

        if($createdProject == null)
        {
            $project->delete(); //por las dudas
            return redirect()->route('proyectos.index',['success'=>false]);
        }

        $stats = new Stat();
        $stats->project_id = $createdProject->id;
        $stats->save();

        $link = new Link();
        $link->github = $request->github != null ? $request->github : null;
        $link->web = $request->web != null ? $request->web : null;
        $link->project_id = $createdProject->id;
        $link->save();
       
        return redirect()->route('proyectos.index',['success'=>true]);    
    }

    public function saveImage(Request $request):bool|string
    {

        $image = $request->file('img');
        if($image == null)
        {
            return false;
        }

        $imgURL = "projects/".$request->slug.".".$image->clientExtension();        
        if($image!=null)
        {
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        Stat::where('project_id',$project->id)->increment('views');
        
        $stats = Stat::where('project_id',$project->id)->first();
        $links = Link::where('project_id',$project->id)->first();
        
        if($stats == null || $project == null || $links == null)
        {
            return 'Ocurrio un error';
        }

        return view('projects.show',['project'=>$project,'stats'=>$stats,'links'=>$links, 'disabled'=>"disabled"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit',['title'=>'Editar', 'action'=>'Editar proyecto','project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $oldData = $project;
        $imageURL = $oldData->image;
        
        $request->validate([
            'img'=>['nullable','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','unique:projects','regex:/^[a-zA-Z\-]+$/'], //no esta completamente bien validado! tal vez con el setter o en el front?
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'tags'=>'regex:/^[a-zA-Z0-9,]+$/',
            'visible'=>['nullable','boolean'],             
        ]);

        if($request->img != null)
        {
            unlink(public_path('img/').$oldData->image);
            $imageURL = $this->saveImage($request);            
        }
        else //si no le paso img
        {
            //Renombro la imagen existente con el nuevo slug
            $extension = pathinfo(public_path('img/').$oldData->image,PATHINFO_EXTENSION);
            if(rename(public_path('img/').$oldData->image, public_path('img/projects/').$request->slug.'.'.$extension))
            {
                $imageURL = 'projects/'.$request->slug.'.'.$extension;
            }//En caso de error coloco un placeHolder
            else{
                $imageURL = 'projects/extra/no_image.jpg';
            }            
        }

        $success = $project->update([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'image'=>$imageURL,
            'tags'=>$request->tags,
            'visible'=>$request->visible,
        ]);

        return redirect()->route('proyectos.index',['success'=>$success]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
