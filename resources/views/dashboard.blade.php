@extends('layouts.mainTemplate')
@section('title', 'Dashboard')
@section('description','Panel de control de la pagina')
@section('keywords',"")

@section('head')
<meta name="_token" content="{{csrf_token()}}">
<script type="module" src="{{asset('js/consts.js')}}"></script>
<script type="module" src="{{asset('js/dashboard/statsPage.js')}}"></script>
@endsection

<body class="bg-stone-700">

    @include('layouts.partials.dashboardNav')

    <!--POPUP-->
    <div id="confirmPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-30 backdrop-blur-sm hidden">
        <div class="bg-gray-200 px-8 py-4 rounded-sm shadow-lg max-w-[650px]">
            
        <h2 class="text-xl font-bold mb-4 text-black">Confirmar</h2>
        <p class="text-red-400 font-semibold">NO HAY VUELTA ATRÁS:</p>
        <p class="mb-4"> Esta accion NO puede deshacerse, haga click en CONFIRMAR para continuar.</p>
        <hr class="min-h-[3px] rounded-full bg-white bg-opacity-50 border-none">

        <button id="acceptBtn" class="font-semibold mt-2 px-4 py-2 bg-lime-600 text-white rounded-md hover:bg-lime-500 auto_fade min-w-full disabled:bg-lime-300">CONFIRMAR</button>
        <button id="cancelBtn" class="font-semibold mt-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 auto_fade min-w-full disabled:bg-red-300">CANCELAR</button>
    
        </div>
    </div>

    <!--CONTAINER-->
    <div id="stats_container" class="mx-2 md:mx-4 grid grid-flow-row grid-cols-2 grid-rows-4 gap-8">
      
      <!--CARD-->
      <div class="bg-stone-800 rounded-lg col-span-full md:col-span-1 shadow-lg flex items-center">
        <div class="flex">
          <img src="{{asset('img/icons/UI/eye.svg')}}" class="w-[32px] ms-4 opacity-70">
          <h2 class="text-stone-300 font-semibold ms-2 text-[22px]">Visitas:</h2>
        </div>        
        <div class="flex items-center justify-end me-4 w-full">
          <p class="text-stone-300 font-semibold text-[52px] me-8">{{$stats->visitas}}</p>
          <button id="restart_views"><img id="restart_views" src="{{asset('img/icons/UI/restart.svg')}}" class="w-[32px] opacity-10"></button>
        </div>
      </div>

      <div class="bg-stone-800 rounded-lg col-span-full md:col-span-1 shadow-lg flex items-center">
        <div class="flex">
          <img src="{{asset('img/icons/UI/contact.svg')}}" class="w-[32px] ms-4 opacity-70">
          <h2 class="text-stone-300 font-semibold ms-2 text-[22px]">Contacto:</h2>
        </div>        
        <div class="flex items-center justify-end me-4 w-full">
          <p class="text-stone-300 font-semibold text-[52px] me-8">{{$stats->interacciones_contacto}}</p>
          <button id="restart_contact"><img id="restart_contact" src="{{asset('img/icons/UI/restart.svg')}}" class="w-[32px] opacity-10"></button>
        </div>
      </div>

      <div class="bg-stone-800 rounded-lg col-span-full md:col-span-1 shadow-lg flex items-center">
        <div class="flex">
          <img src="{{asset('img/icons/UI/linkedin.svg')}}" class="w-[32px] ms-4 opacity-70">
          <h2 class="text-stone-300 font-semibold ms-2 text-[22px]">Linkedin:</h2>
        </div>        
        <div class="flex items-center justify-end me-4 w-full">
          <p class="text-stone-300 font-semibold text-[52px] me-8">{{$stats->vistas_linkedin}}</p>
          <button id="restart_linkedin"><img id="restart_linkedin" src="{{asset('img/icons/UI/restart.svg')}}" class="w-[32px] opacity-10"></button>
        </div>
      </div>

      <div class="bg-stone-800 rounded-lg col-span-full md:col-span-1 shadow-lg flex items-center">
        <div class="flex">
          <img src="{{asset('img/icons/UI/github.svg')}}" class="w-[32px] ms-4 opacity-70">
          <h2 class="text-stone-300 font-semibold ms-2 text-[22px]">GitHub:</h2>
        </div>        
        <div class="flex items-center justify-end me-4 w-full">
          <p class="text-stone-300 font-semibold text-[52px] me-8">{{$stats->visitas_github}}</p>
          <button id="restart_github"><img id="restart_github" src="{{asset('img/icons/UI/restart.svg')}}" class="w-[32px] opacity-10"></button>
        </div>
      </div>

    </div>

</body>