@extends('layouts.mainTemplate')
@section('title', 'Leandro Guia | Webdev')
@section('description','Pagina web personal')
@section('keywords',"conjunto, de, etiquetas")

@section('head')
<script type="module" src="{{asset('js/consts.js')}}"></script>
<script type="module" src="{{asset('js/home/home.js')}}"></script>
<script type="module" src="{{asset('js/home/contactForm.js')}}"></script>
<script type="module" src="{{asset('js/home/animation.js')}}"></script>
@endsection

@section('body')

<nav class="font-com font-light text-[16px] lg:text-[18px] fixed flex items-center top-0 w-full p-2 transition duration-1000 ease-in-out z-50" id="navbar">
  <a class="hidden md:inline text-white mx-3 hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#proyectos">Proyectos</a>
  <a class="hidden md:inline text-white mx-3 hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#aboutme">Sobre mi</a>
  <a class="hidden md:inline text-white mx-3 hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#conocimientos">Conocimientos</a>
  <a class="hidden md:inline text-white mx-3 hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#educacion">Educacion</a>
  <div class="rounded-md hidden md:inline flex items-center justify-center relative">
    <a class="text-white mx-3 hover:text-[#4ea5fc]" href="#educacion">README</a>
    <span class="absolute -top-1 -right-1 bg-red-500/75 text-white w-3 h-3 flex items-center justify-center rounded-full animate-ping_sm"></span>
    <span class="absolute -top-1 -right-1 bg-red-500 text-white w-3 h-3 flex items-center justify-center rounded-full"></span>
  </div>
  
  @auth
  <a href="{{route('dashboard.index')}}" class="text-black font-medium text-md bg-[#fcdc4e] ms-4 py-2 px-5 rounded-full min-w-28 min-h-10 z-10 hover:bg-gray-50 hover:text-black transition duration-500 ease-in-out shadow-lg">Ir al panel</a>
  @endauth
  <button id="contactBtn" class="text-white font-medium text-md bg-[#4ea5fc] me-5 py-2 px-5 rounded-full min-w-28 min-h-10 place-self-end ml-auto z-10 hover:bg-gray-50 hover:text-black transition duration-500 ease-in-out shadow-lg">contacto</button>
</nav>

<main>
<!--Seccion 'hero'-->
<div class="md:min-h-screen w-full top-0 sticky z-10">
  <div class="md:min-h-screen w-full bg-[#212121] grid grid-cols-12 grid-flow-col spacing">    
    <!--Presentacion+links-->
    <div class="flex flex-col col-span-full xl:col-span-7 justify-center">
      
      <div class="mx-auto">
        
        <h1 class="font-lexend font-light mt-20 text-[38px] text-white md:text-[98px] lg:text-[72px] xl:text-[114px] text-center leading-10
        animate-fade-in-right animate-duration-500">Leandro Guia</h1><!--114-->
        <div class="animate-fade-in-right animate-duration-500 animate-delay-300 font-lexend font-light">
          <p class="text-white text-[32px] md:text-[64px] leading-relaxed text-center xl:text-end">Desarrollador <span class="text-blue-400">web</span></p>
        </div>
        <div class="mt-10 mb-3 md:mb-0 flex justify-center
        animate-fade-in-up animate-duration-300 animate-delay-300">
          <button id="linkedinBtn" class="btn_icon mx-8">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/linkedin.png" alt="linkedin"/>
          </button>
          <button id="githubBtn" class="btn_icon mx-8">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/github.png" alt="github"/>
          </button>
        </div>
      
      </div>

    </div>
    
    <!--Foto-->
    <div class="hidden xl:block xl:display-block xl:min-h-full xl:col-span-5">
        <img src="{{asset('img/personal/fotoPersonal.jpg')}}" class="w-full h-full grayscale brightness-50"/> 
    </div>
  </div>
  <div class="bg-white min-w-full min-h-2"></div>
</div>

<!--AboutMe relative-->
<section id="aboutme" class="z-20 relative">
  <div class="p-4 lg:px-11 bg-gray-900 grid grid-flow-col grid-cols-12 min-h-screen">    
    <div class="my-auto font-com flex flex-col justify-center items-center lg:items-start lg:justify-start lg:ps-10 col-span-12 lg:col-span-5 min-h-96 p-2 lg:pt-8 rounded-lg lg:rounded-s-xl lg:rounded-e-none">
      <h2 class="scrollIn left-to-right text-[48px] lg:text-[72px] text-gray-200 font-bold text-center lg:text-left justify-center">Sobre mí</h2>
      <p class="scrollIn left-to-right animate-delay-500 text-[21px] text-center lg:text-left text-gray-200">
        Tengo 21 años, estudiante de una <strong>Tecnicatura universitaria en programación</strong> en la universidad
        <a class="hover:bg-red-400 rounded-full p-1 text-[20px] min-h-[34px] auto_fade underline hover:no-underline" href="https://fra.utn.edu.ar/" target="_blank">UTN-FRA</a>.
        Me considero una persona responsable, seria y comprometida.
        Actualmente busco formar parte de una empresa que me permita demostrar y aplicar mis conocimientos, que me brinde la posibilidad de crecer y 
        mejorar mi habilidad en el código cada día.
      </p>
    </div>

    <div class="hidden lg:flex flex-col items-center justify-center lg:col-span-7 min-h-96 rounded-e-xl scrollIn">        
      <img src="{{asset('img/art/10594781_4498901.svg')}}" class="animate-bounce max-w-[850px] rounded-lg rotate-3 drop-shadow-md hover:rotate-2 transition duration-700 ease-out">
    </div>

  </div>
</section>
</main>
<!--Projs-->
<section id="proyectos" class="z-20 relative bg-fixed bg-cover"
style="
  background-image: url('./img/photos/escritorio.jpg');
  background-position-y:100%;
">
  <div class="backdrop-blur-sm bg-gray-900/50">
    <div class="min-w-screen flex items-center justify-center flex-col p-4">
      <h2 class="scrollIn bot-to-top mt-8 font-com font-bold text-[42px] lg:text-[48px] xl:text-[52px] 2xl:text-[64px] text-white">-PROYECTOS-</h2>
    </div>

    <div id="proj_container" class="grid grid-flow-row md:grid-auto-flow grid-cols-12 px-2 md:px-3 pt-10 font-com">    
      <!-- los proj se autocopletaran aca -->
    </div>
  </div>
  <!--PlaceHolderTitle-->
  <div class="bg-gray-300">
    <div class="bg-indigo-400 mt-4 mb-0 mx-8 rounded-full p-2 flex items-center justify-center proj-placeholder">
      <label class="font-semibold text-white">CARGANDO PROYECTOS</label>
      <img src="{{asset('img/gifs/loaders/loadCircle.gif')}}" class="max-h-[28px] ms-2">
    </div>
  </div>

  <!--PlaceHolderCard-->
  <div class="bg-gray-300 grid grid-flow-row md:grid-auto-flow grid-cols-12 px-2 md:px-3 pt-4 proj-placeholder">           

    <div class="col-span-12 md:col-span-6 flex flex-col bg-white mx-2 xl:mx-8 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14 hover:scale-[1.02] auto_fade">
      <div class="relative">
        <div class="bg-gray-200 min-h-[350px] rounded-t-md"></div>
      </div>
      <div class="flex flex-col mt-3">
        <div class="p-2 bg-gray-200 max-w-[250px] ms-4 max-h-[32px]"></div>
        <div class="flex flex-col p-1 ps-4 min-h-[138px] md:min-h-[124px] lg:min-h-[110px]">
          <div class="bg-gray-200 max-w-[200px] min-h-[20px] m-1 mt-8"></div>
          <div class="bg-gray-200 max-w-[300px] min-h-[20px] m-1"></div>
        </div>
      </div>
      <div class="flex items-end justify-end p-1 min-h-[52px] max-h-[52px]">
        <a href="" class="m-1 p-1 px-3 min-h-10 min-w-24 bg-gray-200 rounded-lg text-white font-semibold auto_fade text-center">
          <p class="my-1"></p>
        </a>
      </div>
    </div>

    <div class="col-span-12 md:col-span-6 flex flex-col bg-white mx-2 xl:mx-8 min-h-[428px] min-w-[320px] w-auto rounded-lg shadow-lg mb-14 hover:scale-[1.02] auto_fade">
      <div class="relative">
        <div class="bg-gray-200 min-h-[350px] rounded-t-md"></div>
      </div>
      <div class="flex flex-col mt-3">
        <div class="p-2 bg-gray-200 max-w-[250px] ms-4 max-h-[32px]"></div>
        <div class="flex flex-col p-1 ps-4 min-h-[138px] md:min-h-[124px] lg:min-h-[110px]">
          <div class="bg-gray-200 max-w-[200px] min-h-[20px] m-1 mt-8"></div>
          <div class="bg-gray-200 max-w-[300px] min-h-[20px] m-1"></div>
        </div>
      </div>
      <div class="flex items-end justify-end p-1 min-h-[52px] max-h-[52px]">
        <a href="" class="m-1 p-1 px-3 min-h-10 min-w-24 bg-gray-200 rounded-lg text-white font-semibold auto_fade text-center">
          <p class="my-1"></p>
        </a>
      </div>
    </div>

  </div>


</section>

<!--Conocimientos-->
<section id="conocimientos" class="z-10 relative font-com bg-fixed"
style="
  background-image: url('./img/photos/programacion.jpg');
  background-position-y:100%;
">
  <hr class="border-2"></hr>

  <div class="bg-gradient-to-b from-gray-700/50 to-indigo-400/50 backdrop-blur-sm pt-20 pb-44 grid grid-auto-flow grid-cols-12 items-center justify-center">
      <div class="col-span-12 lg:col-span-4 mb-14 lg:pt-14 2xl:pt-24 flex flex-col items-center justify-center lg:items-start lg:justify-start p-3 lg:ps-20">
        <h2 class="text-[48px] text-white font-semibold text-center lg:text-start">Conocimientos</h2>
        <p class="text-center lg:text-start text-white font-semibold text-[22px] lg:text-[23px] 2xl:text-[28px]">Me mantengo al día utilizando, aprendiendo y manteniendo proyectos que utilizan las siguientes tecnologías.</p>
      </div>

      <div class="p-4 col-span-12 lg:col-span-8 mt-16">
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

  <hr class="border-2"></hr>
</section>

<section id="educacion" class="z-10 relative">
  <div class="w-screen h-screen flex flex-col items-center justify-center px-4 bg-gray-900">
    <h2 class="text-white text-[42px] md:text-[48px] xl:text-[58px] font-com font-bold">Educación</h2>
    <!--Universidad-->
    <div class="bg-white min-w-[350px] max-w-[350px] md:max-w-[740px] rounded-lg p-1 flex flex-col md:flex-row min-h-[120px] mb-4 shadow-lg hover_zoom_in z-10">
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

<footer class="bg-white min-h-[64px] p-4 z-10 relative">
  <div class="min-w-full grid grid-cols-12">
    
    <span class="text-gray-500 col-span-full md:col-span-8 lg:col-span-4">
      <h3 class="font-semibold">Contacto:</h3>
      <ul class="ps-2">
        <li>email: <a href="mailto: leandro.guia.dev@gmail.com">leandro.guia.dev@gmail.com</a></li>                  
      </ul>      
    </span>

    <span class="text-gray-500 col-span-full md:col-span-8 lg:col-span-4">
      <h3 class="font-semibold">Recursos:</h3>
      <ul class="ps-2">
        <li><a href="https://icons8.com/icon/8808/linkedin" target="_blank">LinkedIn logo por <strong>icons8</strong></a></li>                  
        <li><a href="https://icons8.com/icon/12599/github" target="_blank">Github logo por <strong>icons8</strong></a></li> 
        <li><a href="https://unsplash.com/es/@trnavskauni?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash" target="_blank">Foto de Trnava University de <strong>Unsplash</strong></a></li> 
      </ul>      
    </span>

    <span class="text-gray-500 col-span-full md:col-span-4 lg:col-span-4">
      <h3 class="font-semibold">Gracias:</h3>
      <p>Aún sigo trabajando cada día en mejorar la página :)</p>     
    </span>

  </div>
</footer>



<!--POPUP-->
<div id="contactPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-30 backdrop-blur-sm hidden">
  <div class="bg-neutral-700 px-8 py-4 rounded-sm shadow-lg max-w-[650px]">
      
    <h2 class="text-xl font-bold mb-4 text-white">Trabajemos juntos.</h2>
    <p class="text-white mb-4">¡Gracias por el interés!<br>A continuación, puede completar este sencillo formulario para que me ponga en contacto a la brevedad, o si así lo prefiere, puede contactar conmigo directamente via email: <a class="px-2 py-1 bg-blue-500 font-semibold rounded-md" href="mailto:leandro.guia.dev@gmail.com">leandro.guia.dev@gmail.com</a></p>
    <hr class="min-h-[3px] rounded-full bg-white bg-opacity-50 border-none">
      
    <form class="mt-4" id="contactForm">
      @csrf
      <div class="grid grid-cols-12">
        <div class="col-span-6 flex flex-col">
          <input type="email" name="email" id="email" class="me-1 bg-neutral-800 rounded-md p-1 font-semibold text-gray-300 ps-2 outline-none focus:ring-4 focus:ring-indigo-200" placeholder="email" value="{{old('email')}}" required>
          @error('email')
          <small class="little_error">{{$message}}</small>
          @enderror            
        </div>
        <div class="col-span-6 flex flex-col">
          <input type="text" name="name" id="name" class="ms-1 bg-neutral-800 rounded-md p-1 font-semibold text-gray-300 ps-2 outline-none focus:ring-4 focus:ring-indigo-200" placeholder="nombre" value="{{old('name')}}" required>          
          @error('name')
          <small class="little_error">{{$message}}</small>
          @enderror  
        </div>
      </div>
      <textarea name="message" class="bg-neutral-800 mt-2 w-full p-1 rounded-md mb-2 resize-none text-gray-300 outline-none focus:ring-4 focus:ring-indigo-200" placeholder="Escriba un mensaje..." rows="6" required>{{old('message')}}</textarea>
      @error('message')
          <small class="little_error">{{$message}}</small>
      @enderror  

      <input type="text" name="link" id="link" class="bg-neutral-800 rounded-md p-1 text-gray-300  w-full outline-none focus:ring-4 focus:ring-indigo-200" placeholder="Enlace de la oferta (opcional)"> 
      @error('link')
          <small class="little_error">{{$message}}</small>
      @enderror  
      <label class="text-[12px] text-gray-100">En caso de que la oferta se encuentre publicada en internet, puede incluir el enlace.</label>
      <div class="mt-2 w-full">
        <button id="contactSendBtn" class="bg-blue-500 text-white font-semibold p-2 rounded-lg w-full hover:bg-blue-400 auto_fade disabled:bg-blue-300">Solicitar información
      </div>
    </form>
      
    <button id="closePopupBtn" class="font-semibold mt-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 auto_fade min-w-full disabled:bg-red-300">Cerrar</button>
    
    <div class="p-2 pb-0 flex justify-end items-center hidden" id="loaderDiv">
      <img id="loaderAnimation" src="{{asset('img/gifs/loaders/loadCircle.gif')}}" alt="Icono de carga" class="max-h-[24px]">
      <p id="loaderText" class="font-bold text-white ms-1">Enviando...</p>
    </div>

    <div class="p-2 w-full flex justify-end hidden" id="contactForm_notification">
      <p class="font-semibold" id="contactForm_notification_text">Este es un mensaje predeterminado</p>
    </div>

  </div>
</div>


@endsection

<!--ICONS
<a  href="https://icons8.com/icon/8808/linkedin">LinkedIn</a> icon by <a href="https://icons8.com">Icons8</a>

<a  href="https://icons8.com/icon/23882/cv">cv</a> icon by <a href="https://icons8.com">Icons8</a>

<a  href="https://icons8.com/icon/12599/github">GitHub</a> icon by <a href="https://icons8.com">Icons8</a>

Foto de <a href="https://unsplash.com/es/@trnavskauni?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Trnava University</a> en <a href="https://unsplash.com/es/fotos/estanteria-de-madera-marron-con-libros-BEEyeib-am8?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>

pibe sentado: <a href="https://www.vecteezy.com/free-vector/programmer">Programmer Vectors by Vecteezy</a>

pibe sentado mejor: <a href="https://www.freepik.com/free-vector/programmer-concept-illustration_8775515.htm#fromView=search&page=1&position=6&uuid=64e77108-c93f-437c-8a34-527783347aaa">Image by storyset on Freepik</a>

otro mas svg: <a href="https://www.freepik.com/free-vector/code-typing-concept-illustration_10594781.htm#from_view=detail_alsolike">Image by storyset on Freepik</a>
-->
