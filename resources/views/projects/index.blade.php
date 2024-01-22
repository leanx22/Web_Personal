@extends('layouts.mainTemplate')
@section('title', 'PROYECTOS')
@section('description','Listado de mis proyectos')
@section('keywords',"conjunto, de, proyectos")

@section('body')

<nav class="flex items-center bg-white dark:bg-gray-800 w-full p-4 shadow-md z-2 mb-8">
    <a class="md:inline text-gray-400 dark:text-gray-200 mx-3 text-[12px] md:text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#proyectos">
        &larr; Volver</a>        
    <a class="md:inline text-gray-400 dark:text-gray-200 mx-3 text-[12px] md:text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="/src/dashboard.html">
        Estadísticas</a>
    <a href="#" class="md:inline text-gray-400 dark:text-gray-200 mx-3 text-[12px] md:text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="/src/projectsView.html">
        Proyectos</a>
</nav>

<div class="flex flex-col bg-white mx-4 rounded-md p-2 max-w-[950px] md:mx-auto">
    
    <div class="flex items-center justify-center bg-gray-100 border-b-2 min-w-full mb-2">
        <a href="{{route('proyectos.create')}}" class="min-w-full text-gray-400 min-h-[48px] flex items-center justify-center">CREAR NUEVO PROYECTO</a>
    </div>

    @if ($count == 0)
        <label class="text-gray-400 mx-auto">Nada que mostrar...</label>
    @endif

    @foreach ($projects as $project)
    <div class="flex flex-col justify-between bg-gray-100 border-b-2 p-2 min-w-full mb-2">
        <div class="flex">
            <img src="{{asset('img/'.$project->image)}}" class="max-w-[250px] max-h-[192px] rounded-md hidden md:inline">
            <div class="px-2">
                <h3 class="font-semibold text-[18px]">{{$project->title}}</h3>
                <p class="text-[12px] md:text-[16px]">project->description!
                </p>
            </div>
        </div>
        <div class="flex justify-end md:justify-start mt-2">
            <button class="p-2 bg-blue-400 rounded-md min-w-[112px] mb-1 text-[14px] text-white font-bold">Edit</button>
            <button class="p-2 ms-6 bg-red-400 rounded-md min-w-[112px] mb-1 text-[14px] text-white font-bold">Delete</button>
        </div>
    </div>
    @endforeach    

</div>

</html>