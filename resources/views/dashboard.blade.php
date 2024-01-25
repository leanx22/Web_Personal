@extends('layouts.mainTemplate')
@section('title', 'Dashboard')
@section('description','Panel de control de la pagina')
@section('keywords',"")

@section('body')

@include('layouts.partials.dashboardNav')

<div class="min-w-full flex flex-col pt-12 items-center justify-center p-4">
        
    <h2 class="font-bold m-2 text-[18px] text-gray-600">General</h2>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">Visitas totales:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">1</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <h2 class="font-bold m-2 text-[18px] text-gray-600">Interacciones</h2>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">Contacto:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">0</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">LinkedIn:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">0</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>

    <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
        <div class="flex justify-between items-center p-4">
            <h2 class="font-semibold text-gray-400">GitHub:</h2>
            <p class="font-semibold text-[32px] text-gray-400 me-12">0</p>
        </div>
        <button class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
    </div>
</div>
