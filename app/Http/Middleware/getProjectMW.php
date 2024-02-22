<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class getProjectMW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::where('id',$request->project)->orWhere('slug',$request->project)->first();
        if(!$project)
        {
            return response()->json(["message"=>"No se encuentra el proyecto","criterio"=>$request->project])->setStatusCode(404);
        }
        $request->request->remove("project");
        $request->merge(["project"=>$project]);
        return $next($request);
    }
}
