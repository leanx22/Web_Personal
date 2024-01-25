@extends('layouts.mainTemplate')
@section('title', 'Leandro Guia | Webdev')
@section('description','Pagina web personal')
@section('keywords',"conjunto, de, etiquetas")

@section('body')

<nav class="absolute flex items-center top-0 w-full p-4 pt-2 z-2">
  <a class="hidden md:inline text-white font-bold mx-3 text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#proyectos">Proyectos</a>
  <a class="hidden md:inline text-white font-bold mx-3 text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#aboutme">Sobre mi</a>
  <a class="hidden md:inline text-white font-bold mx-3 text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#conocimientos">Conocimientos</a>
  <a class="hidden md:inline text-white font-bold mx-3 text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#educacion">Educacion</a>
  <button class="text-white font-bold text-lg bg-[#4ea5fc] py-2 px-5 rounded-full min-w-28 min-h-10 place-self-end ml-auto z-10 hover:bg-gray-50 hover:text-black transition duration-500 ease-in-out shadow-lg">contacto</button>  
</nav>

<!--Seccion 'hero'-->
<div class="md:min-h-screen w-full">
  <div class="md:min-h-screen w-full bg-[#212121] grid grid-cols-12 grid-flow-col spacing">    
    <!--Presentacion+links-->
    <div class="flex flex-col col-span-full lg:col-span-6 xl:col-span-7 justify-center">
      
      <div class="mx-auto">
        
        <h1 class="mt-20 text-[48px] text-white md:text-[98px] lg:text-[72px] xl:text-[114px] font-bold text-center leading-10">Leandro Guia</h1><!--114-->
        <p class="text-white text-[32px] md:text-[98px] xl:text-[114px] font-bold leading-tight text-center md:text-end"><span class="text-[#4ea5fc] hover:text-red-500 auto_fade">web</span> /dev</p>
      
        <div class="mt-10 mb-3 md:mb-0 flex justify-center">
          <!--  <button class="btn_icon">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/resume.png" alt="resume"/>
          </button> -->
          <button class="btn_icon mx-8">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/linkedin.png" alt="linkedin"/>
          </button>
          <button class="btn_icon mx-8">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/github.png" alt="github"/>
          </button>
        </div>
      
      </div>

    </div>
    
    <!--Foto-->
    <div class="hidden lg:block lg:display-block lg:min-h-full lg:col-span-6 xl:col-span-5 z-1">
      <img src="{{asset('img/personal/fotoPersonal.png')}}" class="w-full h-full grayscale brightness-50 z-1"/>
    </div>

  </div>
  <div class="bg-[#4ea5fc] min-w-full min-h-8"></div>
</div>

<!--AboutMe-->
<section id="aboutme">
  <div class="p-4 pt-[150px] pb-[150px] lg:px-11 py-auto bg-gradient-to-b from-gray-200 to-white grid grid-flow-col grid-cols-12">
    
    <div class="flex flex-col justify-center items-center lg:items-start lg:justify-start lg:ps-10 col-span-12 lg:col-span-5 min-h-96 p-2 lg:pt-8 rounded-lg lg:rounded-s-xl lg:rounded-e-none">
      <h2 class="text-[48px] lg:text-[72px] text-gray-700 font-bold text-center lg:text-left">Sobre mí</h2>
      <p class="text-[21px] text-center lg:text-left text-gray-700">
        Tengo 21 años, estudiante de una <strong>Tecnicatura universitaria en programación</strong> en la universidad
        <a class="hover:bg-gray-800 rounded-full p-1 text-[20px] min-h-[34px] auto_fade underline hover:no-underline hover:text-white" href="https://fra.utn.edu.ar/" target="_blank">UTN-FRA</a>.
        Me considero una persona responsable, seria y comprometida.
        Actualmente busco formar parte de una empresa que me permita demostrar y aplicar mis conocimientos, que me brinde la posibilidad de crecer y 
        mejorar mi habilidad en el código cada día.
      </p>
    </div>

    <div class="hidden lg:flex flex-col items-center justify-center lg:col-span-7 min-h-96 rounded-e-xl">        
      <img src="{{asset('img/photos/programacion.jpg')}}" class="max-w-[550px] rounded-lg rotate-3 shadow-lg hover:scale-95 hover:rotate-1 transition duration-100 ease-out">
    </div>

  </div>
</section>

<!--Projs-->
<section id="proyectos">
  
  <div class="bg-sky-200 grid grid-flow-row md:grid-auto-flow grid-cols-12 px-2 md:px-3 pt-10">

    @foreach ($projects as $project)
      <div class="col-span-12 md:col-span-6 flex flex-col bg-white mx-2 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14 hover:scale-[1.02] auto_fade">
        <!--Superior-->
        <div class="relative">
          <img class="rounded-t-lg min-w-full min-h-full" src="{{asset('img/'.$project->image)}}" alt="Imagen del proyecto">
          <!--Tags-->
          <div class="absolute inset-0 flex items-end justify-end p-4">
            <label class="text-white text-center bg-gray-800/75 p-2 min-w-[58px] ms-1">PHP</label>
            <label class="text-white text-center bg-gray-800/75 p-2 min-w-[58px] ms-1">Laravel</label>
            <label class="text-white text-center bg-gray-800/75 p-2 min-w-[58px] ms-1">TailwindCSS</label>
          </div>              
        </div>
        <!--Inferior-->
        <div class="flex flex-col mt-3">
          <h2 class="text-[24px] font-bold ms-4">{{$project->title}}</h2>
          <div class="flex items-center p-1 ps-4 min-h-[138px] md:min-h-[124px] lg:min-h-[110px]">
            <p class="text-start text-[15px] lg:text-[18px]">
              {!! $project->description !!}
            </p>
          </div>
          
        </div>
        <div class="flex items-end justify-end p-1 min-h-[52px] max-h-[52px]">
          <a href="{{route('proyectos.show',$project)}}" class="m-1 p-1 px-3 min-h-10 min-w-24 bg-black rounded-lg text-white font-semibold auto_fade text-center">
            <p class="my-1">Ver mas</p>
          </a>
        </div>
      </div>
    @endforeach    

    @if ($odd == false)
      <!--Si es impar:-->
      <div class="col-span-12 md:col-span-6 flex items-center justify-center bg-gray-100 mx-2 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14">
        <label class="text-[28px] text-center text-gray-400">Más proyectos próximamente...</label>
      </div>
      <!--end-->
    @endif    

  </div>

</section>

<!--Conocimientos-->
<section id="conocimientos" class="lg:sticky lg:top-0 lg:-z-10">
  <div class="bg-gradient-to-b from-sky-200 to-indigo-400 pt-20 pb-44 grid grid-auto-flow grid-cols-12 items-center justify-center">
      <div class="col-span-12 lg:col-span-4 mb-14 lg:pt-14 2xl:pt-24 flex flex-col items-center justify-center lg:items-start lg:justify-start p-3 lg:ps-20">
        <h2 class="text-[48px] text-white font-semibold text-center lg:text-start">Tecnologias</h2>
        <p class="text-center lg:text-start text-white font-semibold text-[22px] lg:text-[23px] 2xl:text-[28px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus dicta vel provident, asperiores architecto dolor facilis earum at sapiente quod. Quaerat nulla modi aperiam inventore harum error repellendus, architecto dignissimos.</p>
      </div>

      <div class="p-4 col-span-12 lg:col-span-8">
        <div class="w-full grid grid-auto-flow grid-cols-12 lg:grid-cols-5 2xl:grid-cols-6">
          <img src="{{asset('img/icons/techs/laravel.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/php.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/typescript-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/cSharp-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/c-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">                        
          <img src="{{asset('img/icons/techs/html-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/css-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/bootstrap-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">            
          <img src="{{asset('img/icons/techs/tailwind-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/sql-server-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/mysql-logo-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/node.js-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/jquery-144.png')}}" class="col-span-6 md:col-span-3 md:col-start-4 lg:col-span-1 2xl:col-start-3 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
          <img src="{{asset('img/icons/techs/slim-144.png')}}" class="col-span-6 md:col-span-3 lg:col-span-1 lg:max-w-[92px] lg:max-h-[92px] 2xl:max-w-[124px] 2xl:max-h-[124px] mx-auto boxify hover_zoom_in">
        </div>
      </div>
    </div>
  </div>
</section>

<section id="educacion" style="background-image: url('img/photos/libros.jpg')">
  <div class="w-screen h-screen flex flex-col items-center justify-center px-4 backdrop-blur-sm">

    <h2 class="text-white text-[42px] md:text-[48px] xl:text-[58px] font-bold">Educación</h2>
    <!--Universidad-->
    <div class="bg-white min-w-[350px] max-w-[350px] md:max-w-[740px] rounded-lg p-1 flex flex-col md:flex-row min-h-[120px] mb-4 shadow-lg hover_zoom_in">
      <div class="flex items-center justify-center md:min-w-[140px]">
        <img src="img/extras/UTN-small-logo.jpg">
      </div>

      <div class="col-span-8 flex flex-col justify-center">
        <h3 class="font-semibold text-start ms-2 mt-2 md:mt-0">Técnico superior en programación</h3>
        <p class="ms-2">Actualmente cursando en <a class="hover:bg-gray-800 rounded-full p-1 text-[14px] min-h-[34px] auto_fade underline hover:no-underline hover:text-white" href="https://fra.utn.edu.ar/" target="_blank">UTN-FRA</a>.
        <br>Aquí he conseguido la gran mayoría de mis conocimientos hasta el momento y donde desarrollé distintos proyectos propuestos en la cursada. </p>
        <small class="text-gray-500 ms-2 mb-1 font-semibold">Feb. 2023 - Actualidad</small>
      </div>
    </div>

    <!--Secundario-->
    <div class="bg-white min-w-[350px] max-w-[350px] md:min-w-[740px] md:max-w-[850px] rounded-lg p-1 flex flex-col md:flex-row min-h-[120px] mb-4 shadow-lg hover_zoom_in">
      <div class="flex items-center justify-center md:min-w-[140px]">
        <img src="img/extras/Regina-logo.png">
      </div>

      <div class="col-span-8 flex flex-col justify-center">
        <h3 class="font-semibold text-start ms-2 mt-2 md:mt-0">Secundario | Bachiller en economía y administración.</h3>                 
        <small class="text-gray-500 ms-2 mb-2 font-semibold">Ene. 2014 - Dic. 2020</small>
      </div>
    </div>

  </div>
</section>  

@endsection

<!--ICONS
<a  href="https://icons8.com/icon/8808/linkedin">LinkedIn</a> icon by <a href="https://icons8.com">Icons8</a>

<a  href="https://icons8.com/icon/23882/cv">cv</a> icon by <a href="https://icons8.com">Icons8</a>

<a  href="https://icons8.com/icon/12599/github">GitHub</a> icon by <a href="https://icons8.com">Icons8</a>

Foto de <a href="https://unsplash.com/es/@trnavskauni?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Trnava University</a> en <a href="https://unsplash.com/es/fotos/estanteria-de-madera-marron-con-libros-BEEyeib-am8?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  
-->
