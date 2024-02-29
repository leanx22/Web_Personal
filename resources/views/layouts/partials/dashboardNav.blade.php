<nav class="bg-gray-900 w-full shadow-md z-2 mb-8">
    <div class="grid grid-cols-12 bg-stone-800 px-3">
        <div class="col-span-2 my-auto">
            <a href="{{route('index')}}"><img src="{{asset('img/icons/UI/monitor.svg')}}" class="w-[42px] hover:bg-blue-200/50 transition duration-200 ease-in-out rounded-lg"></a>            
        </div>

        <div class="flex flex-row-reverse items-center col-span-10">
            <a><img src="{{asset('img/icons/UI/inbox.svg')}}" class="w-[38px] mx-4"></a>

            <span class="flex items-center flex-row-reverse md:me-8 py-1 px-0 md:px-2
            {{request()->routeIs('proyectos.index') ? 'bg-gradient-to-t from-blue-500/50':'bg-none'}}">
                <a href="{{route('proyectos.index')}}" class="text-gray-200 font-bold ms-2 hidden md:inline">Proyectos</a>
                <a href="{{route('proyectos.index')}}"><img src="{{asset('img/icons/UI/folder.svg')}}" class="w-[42px] mx-4 md:mx-0"></a>
            </span> 

            <span class="flex items-center flex-row-reverse m-0 py-1 md:me-8 px-0 md:px-2
            {{request()->routeIs('dashboard.index') ? 'bg-gradient-to-t from-blue-500/50':'bg-none'}}">
                <a href="{{route('dashboard.index')}}" class="text-gray-200 font-bold ms-2 hidden md:inline">Estadisticas</a>
                <a href="{{route('dashboard.index')}}"><img src="{{asset('img/icons/UI/statistics.svg')}}" class="w-[42px] mx-4 md:mx-0"></a>
            </span>
              
        </div>  
    </div>
</nav>






<!--
    <a class="md:inline text-gray-100 mx-3 text-[12px] md:text-[18px] font-semibold 
    hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="{{route('index')}}">Ir a la web</a>        
    
        <a class="md:inline mx-3 text-[12px] md:text-[18px]      
        {{request()->routeIs('dashboard.index') ? 'text-blue-400 font-semibold':'text-gray-400 dark:text-gray-200 hover:text-[#4ea5fc] transition duration-200 ease-in-out'}}" 
        href="{{route('dashboard.index')}}">
        Estadisticas</a>
    
        <a class="md:inline mx-3 text-[12px] md:text-[18px]      
        {{request()->routeIs('proyectos.index') ? 'text-blue-400 font-semibold':'text-gray-400 dark:text-gray-200 hover:text-[#4ea5fc] transition duration-200 ease-in-out'}}" 
        href="{{route('proyectos.index')}}">
        Proyectos</a>
    -->