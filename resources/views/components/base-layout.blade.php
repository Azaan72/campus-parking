<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Campus Parking System' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at 20% 20%, #1e3a8a 0%, #0f172a 40%, #020617 100%);
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-full flex flex-col text-gray-800 font-sans antialiased">

    {{-- Floating Background Glow --}}
    <div class="fixed inset-0 -z-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600 opacity-20 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-600 opacity-20 blur-3xl rounded-full"></div>
    </div>

    {{-- Header --}}
    <header class="backdrop-blur-xl bg-white/10 border-b border-white/20 shadow-lg">
        <div class="max-w-7xl mx-auto px-8 py-6 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl shadow-lg"></div>
                <h1 class="text-2xl font-bold text-white tracking-wide">
                    Campus Parking System
                </h1>
            </div>

            <nav class="flex gap-4">
                <a href="{{ route('parkingspots.index') }}"
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-950 font-semibold shadow-xl hover:scale-105 hover:shadow-2xl transition duration-300">
                    Parking Spots
                </a>

                <a href="{{ route('users.index') }}"
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-950 font-semibold shadow-xl hover:scale-105 hover:shadow-2xl transition duration-300">
                    Users
                </a>
            </nav>


        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow py-20 px-6">
        <div class="max-w-6xl mx-auto">

            {{-- Premium Card Container --}}
            <div class="bg-white rounded-3xl shadow-2xl p-12 border border-gray-100">

                <div class="mb-10 border-b border-gray-200 pb-6">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                        {{ $title ?? 'Dashboard' }}
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm">
                        Manage and monitor campus parking efficiently.
                    </p>
                </div>

                <div class="text-gray-700 leading-relaxed text-lg">
                    {{ $slot }}
                </div>

            </div>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-950 text-gray-400 py-8 text-center text-sm tracking-wide border-t border-slate-800">
        &copy; {{ date('Y') }} Campus Parking System. All rights reserved.
    </footer>

    @stack('scripts')
</body>

</html>
