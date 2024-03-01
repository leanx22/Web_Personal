@extends('layouts.mainTemplate')
@section('title', $title)
@section('description','Formulario de proyecto')
@section('keywords',"tag")

@section('head')
<script type="module" src="{{asset('js/consts.js')}}"></script>
<script type="module" src="{{asset('js/dashboard/projects/edit.js')}}"></script>
@endsection

<body class="bg-stone-700">  
<nav class="flex items-center bg-stone-800 w-full p-4 shadow-md z-2 mb-8">
    <a href="{{route('proyectos.index')}}" class="md:inline text-gray-200 mx-3 text-[12px] md:text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#proyectos">
        &larr; Cancelar</a>        
</nav>

<div class="min-w-full flex-col">
    <form id="form" method="POST" class="bg-stone-800  md:max-w-[700px] mx-4 md:mx-auto rounded-md p-4 flex flex-col shadow-lg text-stone-200" enctype="multipart/form-data">
        @csrf

        <h1 class="font-semibold text-[24px]">{{$action}}</h1>
        
        <label class="font-light mt-4">Título</label>
        <input id="title" type="text" name="title" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" placeholder="Nuevo titulo" required value="{{old('title',$project->title)}}">

        @error('name')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light mt-4">Slug</label>
        <input id="slug" type="text" name="slug" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" placeholder="Ej: un-slug-nuevo" required value="{{old('slug',$project->slug)}}">

        @error('slug')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light mt-4">Descripción</label>
        <textarea id="description" name="description" rows="5" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" required>{{old('description',$project->description)}}</textarea>

        @error('description')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light mt-4">Imagen</label>
        <small class="font-light">(Solo JPG/JPEG)</small>
        @error('img')
            <small class="little_error">{{$message}}</small>
        @enderror
        <div class="flex flex-col items-center mt-4">
            <img src="{{asset('img/'.$project->image)}}" class="max-w-[250px] rounded-md border-2 border-stone-600 shadow-md">
            <input id="img" type="file" name="img" value="{{old('img')}}" class="text-[14px] p-2 rounded-md file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-stone-700 file:text-stone-200" onchange="">
        </div>                

        <label class="font-light mt-4">Github (opcional)</label>
        <input id="github" type="text" name="github" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" placeholder="https://github.com/user/example-repo" value="{{old('github',$links->github)}}">

        @error('github')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light mt-4">WebLink (opcional)</label>
        <input id="web" type="text" name="web" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" placeholder="https://windows2.net/home" value="{{old('web',$links->web)}}">

        @error('web')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light mt-4">Etiquetas (separadas por coma)</label>
        <input id="tags" type="text" name="tags" class="bg-stone-900 outline-none ring-none ring-stone-700 focus:ring-2 rounded-lg text-[14px] p-2" placeholder="Programacion, PHP, MySQL, Laravel..." value="{{old('tags',$project->tags)}}">

        @error('tags')
            <small class="little_error">{{$message}}</small>
        @enderror

        <span class="mt-4 mb-2 flex items-center ms-2">
            <label for="visibleCheckbox" class="font-light">Visible en la página principal:</label>
            <input id="visible_cbox" type="checkbox" name="visible" id="visibleCheckbox" class="text-[14px] p-2 w-[24px] h-[24px] ms-2" value="1" {{$project->visible == 1 ? 'checked':''}}>
        </span>

        @error('visible')
            <small class="little_error">{{$message}}</small>
        @enderror

        <span class="ms-2">
            <label for="orderInput" class="font-light">Orden:</label>
            <input type="number" name="order" id="orderInput" value="{{old('order',$project->order)}}" min="1" max="100"
            class="max-w-[64px] bg-stone-900 border-2 border-stone-700 rounded-md p-1 ms-4">
            <small class="text-[12px] text-gray-400"><br>*Significa el orden en el que se muestran los proyectos.</small>
        </span>        

        @error('order')
            <small class="little_error">{{$message}}</small>
        @enderror

        <input type="hidden" name="search" value="{{$project->slug}}">
        <button id="sendBtn" type="button" class="bg-lime-500 rounded-md p-2 m-2 text-white font-semibold">Guardar</button>
    </form>
    <form id="del_form" method="POST" class="bg-stone-800 md:max-w-[700px] mx-4 md:mx-auto rounded-md p-4 flex flex-col shadow-lg">
        @csrf
        @method("DELETE")
        <input type="hidden" name="search" value="{{$project->slug}}">
        <button id="deleteBtn" class="bg-red-300 rounded-md p-2">Eliminar proyecto</button>
    </form>
    
</div>

<div id="error_prompt" class="fixed bottom-5 md:right-5 flex md:justify-center md:items-center max-w-[450px] mx-auto md:mx-0 hidden">
    <div class="bg-red-300 ring-2 ring-red-600 p-2 rounded-md flex flex-col m-2">
        <ul id="lista_errores" class="list-square list-inside text-red-800">
        </ul>
        <button id="close_errors" class="m-1 text-red-800 opacity-70 underline">Cerrar</button>
    </div>
</div>
</body>

</html>