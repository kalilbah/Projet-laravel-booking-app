<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trim(($title ?? '').' | '.config('app.name', 'Laravel'), ' |') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[28rem] bg-[radial-gradient(circle_at_top_left,_rgba(30,64,175,0.22),_transparent_40%),radial-gradient(circle_at_top_right,_rgba(147,51,234,0.16),_transparent_30%),linear-gradient(180deg,_#f8fafc_0%,_#eef2ff_45%,_#f8fafc_100%)]"></div>

        @include('layouts.navigation')

        @php
        $headerContent = $header ?? View::getSection('header');
        @endphp

        @if ($headerContent)
        <header class="border-b border-white/60 bg-white/70 backdrop-blur">
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                {!! $headerContent !!}
            </div>
        </header>
        @endif

        <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            {{ $slot ?? '' }}

            @hasSection('content')
            @yield('content')
            @endif
        </main>
    </div>

    @livewireScripts
</body>

</html>