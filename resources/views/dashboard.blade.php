@extends('layouts.mainTemplate')
@section('title', 'Dashboard')
@section('description','Panel de control de la pagina')
@section('keywords',"")

@section('body')

@include('layouts.partials.dashboardNav')

<div class="min-w-full flex flex-col items-center justify-center p-4 pt-0">
        
    <h2 class="font-bold text-[18px] text-gray-400">GENERAL</h2>
    
    <hr class="bg-gray-300 h-[2px] w-full max-w-[600px] mb-2 border-0">
    
    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">Visitas totales:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->visitas}}</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <h2 class="font-bold text-[18px] text-gray-400">INTERACCIONES</h2>

    <hr class="bg-gray-300 h-[2px] w-full max-w-[600px] mb-2 border-0">

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">Contacto:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->interacciones_contacto}}</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">LinkedIn:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->vistas_linkedin}}</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">GitHub:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->visitas_github}}</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>
</div>
