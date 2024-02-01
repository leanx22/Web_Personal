<!DOCTYPE html>
<html lang="es" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Leandro Guia">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
    <title>@yield('title')</title>
</head>
<body class="bg-gray-200">
    @yield('body')
</body>
</html>