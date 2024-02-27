@extends('layouts.mainTemplate')
@section('title', $project->title)
@section('description','Ver el proyecto')
@section('keywords',"{{$project->tags}}")

@section('head')
<script type="module" src="{{asset('js/consts.js')}}"></script>
<script type="module" src="{{asset('js/project/show.js')}}"></script>
@endsection

@section('body')
<nav class="flex items-center bg-black/50 backdrop-blur-sm w-full p-4 shadow-md z-2 fixed">
    <a class="md:inline text-white dark:text-gray-200 mx-3 text-[18px] hover:text-sky-200 transition duration-200 ease-in-out" href="{{route('index',['section'=>'#proyectos'])}}">&larr; Volver al inicio</a>        
</nav>

</div>
<!--contenedor-->
<div class="p-4 min-h-screen bg-center bg-cover"
style="
    background-image: url('../img/photos/escritorio.jpg');
    background-position-y:100%;
"> 
    <!--Card-->      
    <div class="mx-auto mt-16 bg-black/70 backdrop-blur-md w-full max-w-[1450px] min-h-2 shadow-lg rounded-md grid grid-cols-12 md:py-8">
        <!--Img&Btns-->
        <div class="col-span-12 md:col-span-6 p-1 flex flex-col items-center min-w-[290px]">
            <img src="{{asset('img/'.$project->image)}}" class="rounded-md max-h-[250px] md:max-h-[350px]">
            <div class="p-1">
                <small id="stat_views" class="text-gray-300 ms-4">Cargando vistas...</small>
                <small id="stat_interactions" class="text-gray-300 ms-8">Cargando interacciones...</small>
            </div>
            <div class="flex flex-col items-center lg:w-full lg:px-4">
                <button id="btn_github" class="p-2 rounded-md bg-indigo-500 text-white font-bold min-w-[250px] min-h-[64px] lg:w-full lg:max-w-[375px] my-1 shadow-md
                hover:bg-indigo-400 auto_fade disabled:bg-gray-800 disabled:text-gray-500" disabled>GitHub</button>
                
                <button id="btn_web" class="p-2 rounded-md bg-lime-600 text-white font-bold min-w-[250px] min-h-[64px] lg:w-full lg:max-w-[375px] my-1 shadow-md
                 hover:bg-lime-500 auto_fade disabled:bg-gray-300" disabled>Ver en web</button>
            </div>
        </div>
        <!--Desc&links-->
        <div class="col-span-12 max-w-[680px] md:col-span-6 min-w-[290px] p-2 lg:px-8 xl:px-16">
            <h1 class="text-white font-bold text-xl text-center md:text-start">{{$project->title}}</h1>
            <p class="text-gray-200">{!! $project->description !!}</p>
            <div class="mt-4 flex flex-col">
                <!--
                <h3 class="text-gray-700 dark:text-white">Descargas:</h3>
                <a href="#" class="text-blue-600 hover:text-sky-600">readme.md</a>
                <a href="#" class="text-blue-600 hover:text-sky-600">doc.pdf</a>
                -->
            </div>
        </div>
    </div>
</div>