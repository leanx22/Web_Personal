<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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
            'img'=>['nullable','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','unique:projects'], //no esta completamente bien validado! tal vez con el setter o en el front?
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'visible'=>['nullable','boolean']
            //tags sin validar!            
        ]);
        
        $project = new Project();
        $project->title = $request->title;
        $project->slug = $request->slug;
        $imageSaveResponse = $this->saveImage($request); 
        $project->image = $imageSaveResponse == false ? null : $imageSaveResponse;
        $project->description = $request->description;
        $project->tags = $request->tags;
        $project->visible = $request->visible == null ? false:$request->visible;
        //$project->order = $request->order;
        $actionSuccess = $project->save();
        return redirect()->route('proyectos.index',['actionSuccess'=>$actionSuccess]);    
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
                return response()->view('', [], 500); //todo: cambiar la vista retornada!
            }
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show',['project'=>$project]); //aca tengo que pasar la data del curso, no el id. cambiar.
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
        $request->validate([
            'img'=>['nullable','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','unique:projects'], //no esta completamente bien validado! tal vez con el setter o en el front?
            'github'=>['nullable','url'],
            'web'=>['nullable','url'],
            'visible'=>['nullable','boolean']
            //tags sin validar!            
        ]);

        if($request->img != null)
        {
            $imageSaveResponse = $this->saveImage($request); 
            $project->image = $imageSaveResponse == false ? null : $imageSaveResponse;
        }

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
