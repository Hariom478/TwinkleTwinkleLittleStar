<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

      <!-- ✅ Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- @livewireStyles --}}
</head>

<div
    x-data="{ show: false, message: '' }"
    x-on:toast.window="
        message = $event.detail;
        show = true;
        setTimeout(() => show = false, 3000);
    "
    class="fixed top-5 right-5 z-[9999]"
>

    <div
        x-show="show"
        x-transition
        class="bg-blue-600 text-white px-4 py-2 rounded shadow-lg"
    >
        <span x-text="message"></span>
    </div>

</div>

<body class="font-sans antialiased">

    <!-- Navbar -->
    <livewire:layout.navigation />

    <div class="flex">

        <!-- Sidebar -->
        <div class="w-64 h-screen bg-emerald-600">
            <livewire:layout.sidebar />
        </div>

        <!-- Content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            @if (isset($header))
                <header class="bg-white shadow p-4">
                    {{ $header }}
                </header>
            @endif

            <!-- Main -->
            <main class="flex-1 p-6">
                {{ $slot ?? '' }}
            </main>

        </div>

    </div>

    <!-- ✅ THIS WAS MISSING -->
    @livewireScripts

</body>
</html>
