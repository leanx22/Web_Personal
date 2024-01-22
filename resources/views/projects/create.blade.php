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
    <form action="{{route('proyectos.store')}}" method="POST" class="bg-white md:max-w-[700px] mx-4 md:mx-auto rounded-md p-4 flex flex-col shadow-lg" enctype="multipart/form-data">
        
        @csrf

        <h2 class="font-semibold text-gray-400 text-[24px]">{{$action}}</h2>
        
        <label class="font-light text-gray-500 mt-4">Título</label>
        <input type="text" name="title" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Windows 2!" required value={{old('title')}}>

        @error('name')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Slug</label>
        <input type="text" name="slug" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Ej: un-link-increíble" required value={{old('slug')}}>

        @error('slug')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Descripción</label>
        <textarea name="description" rows="5" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Una bonita descripción..." value={{old('description')}} required></textarea>

        @error('description')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Imagen</label>
        <input type="file" name="img" class="text-[14px] p-2">

        @error('img')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Github (opcional)</label>
        <input type="text" name="github" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="https://github.com/user/example-repo" value={{old('github')}}>

        @error('github')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">WebLink (opcional)</label>
        <input type="text" name="web" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="https://windows2.net/home" value={{old('web')}}>

        @error('web')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Etiquetas (separadas por coma)</label>
        <input type="text" name="tags" class="bg-gray-100 rounded-lg text-[14px] p-2" placeholder="Programacion, PHP, MySQL, Laravel..." value={{old('tags')}}>

        @error('tags')
            <small class="little_error">{{$message}}</small>
        @enderror

        <label class="font-light text-gray-500 mt-4">Visible en la página principal:</label>
        <input type="checkbox" name="visible" value="1" class="text-[14px] p-2" placeholder="https://github.com/user/example-repo" value={{old('visible')}}>

        @error('visible')
            <small class="little_error">{{$message}}</small>
        @enderror

        <button type="submit" class="bg-lime-500 rounded-md p-2 m-2 text-white font-semibold">Guardar</button>
    </form>
</div>

</html>