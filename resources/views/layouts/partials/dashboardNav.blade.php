<nav class="flex items-center bg-white dark:bg-gray-800 w-full p-4 shadow-md z-2 mb-8">
    <a class="md:inline text-gray-400 dark:text-gray-200 mx-3 text-[12px] md:text-[18px] 
    hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="{{route('index')}}">
        &larr; Volver</a>        
    
        <a class="md:inline mx-3 text-[12px] md:text-[18px]      
        {{request()->routeIs('dashboard.index') ? 'text-blue-400 font-semibold':'text-gray-400 dark:text-gray-200 hover:text-[#4ea5fc] transition duration-200 ease-in-out'}}" 
        href="{{route('dashboard.index')}}">
        Estadisticas</a>
    
        <a class="md:inline mx-3 text-[12px] md:text-[18px]      
        {{request()->routeIs('proyectos.index') ? 'text-blue-400 font-semibold':'text-gray-400 dark:text-gray-200 hover:text-[#4ea5fc] transition duration-200 ease-in-out'}}" 
        href="{{route('proyectos.index')}}">
        Proyectos</a>
</nav>