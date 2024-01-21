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
        $projects = Project::all();
        return view('projects.index',['projects',$projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'img'=>['sometimes','image','mimes:jpg,jpeg','extensions:jpg,jpeg'],
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            'slug'=>['required','min:3','lowercase'], //no esta completamente bien validado!
            'visible'=>['boolean']
            //tags sin validar!            
        ]);
        
        $project = new Project();
        $project->title = $request->title;
        $project->slug = $request->slug;
        $imageSaveResponse = $this->saveImage($request); 
        $project->image = $imageSaveResponse == false ? null : $imageSaveResponse;
        $project->tags = $request->tags;
        $project->visible = $request->visible;
        $project->save();
        //retornar a la pagina de proyectos con un popup de guardado correcto!       
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
    public function show(string $id)
    {
        return view('projects.show',['curso'=>$id]); //aca tengo que pasar la data del curso, no el id. cambiar.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
