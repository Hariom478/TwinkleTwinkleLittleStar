<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

    <!-- ✅ Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>

<body class="bg-gray-100">

    <!-- 🔥 NAVBAR -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold text-blue-600">
                <a href="/" >MyShop</a>
            </h1>

            <div class="flex gap-6 text-sm">

                <a href="/" class="hover:text-blue-600">Home</a>

                @if (!empty(auth()->user()))
                    <a href="#" class="hover:text-blue-600">Cart</a>
                    <span class="text-gray-600">
                        👋 {{ auth()->user()->name }}
                    </span>
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Logout</a>

                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-600">Register</a>
                @endif

            </div>

        </div>
    </header>

    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>
