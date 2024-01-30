@extends('layouts.mainTemplate')
@section('title', 'Iniciar sesion')
@section('description','Iniciar sesion')
@section('keywords',"")

@section('body')
<div class="flex h-screen w-screen p-4 items-center justify-center">
    <div class="flex flex-col items-center justify-center bg-white p-2 rounded-md shadow-lg">
        <h1 class="font-semibold text-[24px] text-gray-500">Inicio de sesión</h1>
        <form class="mt-1 p-1 rounded-lg" method="POST">
            @csrf
            <input name="email" type="email" class="bg-gray-200 p-2 rounded-lg" placeholder="Correo" required>
            <input name="password" type="password" class="bg-gray-200 p-2 rounded-lg" placeholder="Clave" required><br>
            <button type="submit" class="bg-blue-500 rounded-full p-2 w-full mt-2 font-semibold text-white
            shadow-md hover:bg-blue-600 auto_fade">Iniciar sesión</button>
        </form>
    </div>
</div>