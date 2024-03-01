@extends('layouts.mainTemplate')
@section('title', 'Iniciar sesion')
@section('description','Iniciar sesion')
@section('keywords',"")

@section('head')
<script type="module" src="{{asset('js/consts.js')}}"></script>
<script type="module" src="{{asset('js/auth/login.js')}}"></script>
@endsection

<body class="bg-stone-900">
  <div class="flex h-screen w-screen p-4 items-center justify-center">
    <div class="flex flex-col items-center justify-center bg-stone-800 p-2 rounded-md shadow-lg text-gray-200">
      <h1 class="font-semibold text-[24px]">Inicio de sesión</h1>
      <form id="loginForm" class="mt-1 p-1 rounded-lg" method="POST">
        @csrf
        <input name="email" type="email" class="bg-stone-900 p-2 rounded-lg outline-none ring-none ring-stone-600 focus:ring-1" placeholder="Correo" required>
        <input name="password" type="password" class="bg-stone-900 p-2 rounded-lg outline-none ring-none ring-stone-600 focus:ring-1" placeholder="Clave" required><br>
        <button class="bg-stone-900 border border-stone-700 rounded-lg p-2 w-full mt-2 font-semibold text-white
        shadow-md hover:bg-indigo-600 hover:border-indigo-600 auto_fade" id="sendBtn" type="button">Iniciar sesión</button>
        <div id="loader_container" class="bg-gray-500 mt-2 rounded-lg p-2 flex items-center hidden">
            <img src="{{asset('img/gifs/loaders/loadCircle.gif')}}" class="max-h-[32px]">
            <label class="text-white ms-2">Iniciando sesion...</label>
        </div>
        <div class="mt-2 p-2 rounded-md max-w-[410px] hidden" id="message_container">
            <p class="text-[14px]" id="message_text">prueba</p>
        </div>
      </form>
    </div>
  </div>
</body>