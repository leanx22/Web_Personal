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
          <img src="{{asset('img/icons/UI/inbox.svg')}}" class="w-[32px] ms-4">
          <h2 class="text-stone-300 font-semibold ms-2 text-[22px]">Contacto:</h2>
        </div>        
        <div class="flex items-center justify-end me-4 w-full">
          <p class="text-stone-300 font-semibold text-[52px] me-8">0</p>
          <a href="#"><img src="{{asset('img/icons/UI/restart.svg')}}" class="w-[32px] opacity-10"></a>
        </div>
      </div>

    </div>


    {{-- <div id="stats_container" class="min-w-full flex flex-col items-center justify-center p-4 pt-0">
            
        <h2 class="font-bold text-[18px] text-gray-400">GENERAL</h2>
        
        <hr class="bg-gray-300 h-[2px] w-full max-w-[600px] mb-2 border-0">
        
        <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
            <div class="flex justify-between items-center p-4">
                <h2 class="font-semibold text-gray-400">Visitas totales:</h2>
                <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->visitas}}</p>
            </div>
            <button id="restart_views" class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
        </div>

        <h2 class="font-bold text-[18px] text-gray-400">INTERACCIONES</h2>

        <hr class="bg-gray-300 h-[2px] w-full max-w-[600px] mb-2 border-0">

        <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
            <div class="flex justify-between items-center p-4">
                <h2 class="font-semibold text-gray-400">Contacto:</h2>
                <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->interacciones_contacto}}</p>
            </div>
            <button id="restart_contact" class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
        </div>

        <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
            <div class="flex justify-between items-center p-4">
                <h2 class="font-semibold text-gray-400">LinkedIn:</h2>
                <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->vistas_linkedin}}</p>
            </div>
            <button id="restart_linkedin" class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
        </div>

        <div class="bg-white rounded-md min-w-[300px] w-full max-w-[650px] flex flex-col shadow-md mb-8">
            <div class="flex justify-between items-center p-4">
                <h2 class="font-semibold text-gray-400">GitHub:</h2>
                <p class="font-semibold text-[32px] text-gray-400 me-12">{{$stats->visitas_github}}</p>
            </div>
            <button id="restart_github" class="bg-red-400 rounded-b-md p-1 font-semibold text-white">Reiniciar</button>                  
        </div>
    </div> --}}
</body>