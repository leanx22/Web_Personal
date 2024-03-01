@extends('layouts.mainTemplate')
@section('title', 'PROYECTOS')
@section('description','Listado de mis proyectos')
@section('keywords',"conjunto, de, proyectos")

<body class="bg-stone-700">

    @include('layouts.partials.dashboardNav')

    <div class="flex flex-col bg-stone-900 shadow-lg mx-4 rounded-md p-2 max-w-[950px] md:mx-auto">
        
        <div class="flex items-center justify-center bg-stone-800 border-b-2 border-stone-700 min-w-full mb-2">
            <a href="{{route('proyectos.create')}}" class="min-w-full text-gray-200 min-h-[48px] flex items-center justify-center">CREAR NUEVO PROYECTO</a>
        </div>

        @if ($count == 0)
            <label class="text-gray-200 mx-auto">Nada que mostrar...</label>
        @endif

        @foreach ($projects as $project)
        <div class="flex flex-col justify-between bg-stone-800 border-b-200 border-stone-500 p-2 min-w-full mb-2 rounded-sm text-gray-200">
            <div class="flex">
                <img src="{{asset('img/'.$project->image)}}" class="max-w-[250px] max-h-[192px] rounded-lg border-2 hidden md:inline">
                <div class="px-2">
                    <h3 class="font-semibold text-[18px]">{{$project->title}}</h3>
                    <p class="text-[12px] md:text-[16px]">{!!$project->description!!}
                    </p>
                </div>
            </div>
            <div class="flex justify-between md:items-center mt-2 p-1 min-w-[250px] max-w-[250px] md:min-w-full md:justify-end">
                <a href="{{route('proyectos.show',$project)}}" class="p-2 bg-stone-900 border border-stone-700 rounded-md min-w-[112px] text-[14px] text-center text-white font-bold">View</a>
                <a href="{{route('proyectos.edit',$project)}}" class="p-2 bg-stone-900 border border-stone-700 rounded-md min-w-[112px] text-[14px] text-center text-white font-bold md:mx-4">Edit</a>                
            </div>
        </div>
        @endforeach    

    </div>
</body>