@extends('layouts.mainTemplate')
@section('title', $title)
@section('description','Formulario de proyecto')
@section('keywords',"tag")

@section('body')    
<nav class="flex items-center bg-white dark:bg-gray-800 w-full p-4 shadow-md z-2 mb-8">
    <a href="{{route('proyectos.index')}}" class="md:inline text-gray-400 dark:text-gray-200 mx-3 text-[12px] md:text-[18px] hover:text-[#4ea5fc] transition duration-200 ease-in-out" href="#proyectos">
        &larr; Cancelar</a>        
</nav>

<div class="min-w-full flex-col">
    <form action="{{route('proyectos.update', $project)}}" method="POST" class="bg-white md:max-w-[700px] mx-4 md:mx-auto rounded-md p-4 flex flex-col shadow-lg" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <h2 class="font-semibold text-gray-400 text-[24px]">{{$action}}</h2>
        
        <label class="font-light text-gray-500 mt-4">Título</label>
        <input type="text" name="title" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Nuevo titulo" required value={{old('title',$project->title)}}>

        @error('name')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Slug</label>
        <input type="text" name="slug" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Ej: un-slug-nuevo" required value={{old('slug',$project->slug)}}>

        @error('slug')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Descripción</label>
        <textarea name="description" rows="5" class="bg-gray-100 rounded-lg text-[14px] p-2" required>{{old('description',$project->description)}}</textarea>

        @error('description')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Imagen</label>
        <small class="font-light text-gray-500">(Solo JPG/JPEG)</small>
        @error('img')
            <small class="little_error">{{$message}}</small>
        @enderror
        <div class="flex flex-col items-center mt-4">
            <img src="{{asset('img/'.$project->image)}}" class="max-w-[250px] rounded-md border-4 border-blue-400 shadow-md">
            <input type="file" name="img" value="{{old('img')}}" class="text-[14px] p-2" onchange="">
        </div>                

        <label class="font-light text-gray-500 mt-4">Github (opcional)</label>
        <input type="text" name="github" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="https://github.com/user/example-repo">

        @error('github')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">WebLink (opcional)</label>
        <input type="text" name="web" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="https://windows2.net/home">

        @error('web')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Etiquetas (separadas por coma)</label>
        <input type="text" name="tags" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Programacion, PHP, MySQL, Laravel..." value={{old('tags',$project->tags)}}>

        @error('tags')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Visible en la página principal:</label>
        <input type="checkbox" name="visible" class="text-[14px] p-2" value="1" {{$project->visible == 1 ? 'checked':''}}>

        @error('visible')
            <small class="little_error">{{$message}}</small>
        @enderror

        <button type="submit" class="bg-lime-500 rounded-md p-2 m-2 text-white font-semibold">Guardar</button>
    </form>
</div>

</html>