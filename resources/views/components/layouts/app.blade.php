<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-stone-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') ?? 'YouTube Tracker' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
@if (Session::has('flash.success'))
    <x-toast
        :message="Session::get('flash.success')"
    />
@endif
<x-navbar/>
{{ $slot }}
@livewireScripts
</body>
</html>
