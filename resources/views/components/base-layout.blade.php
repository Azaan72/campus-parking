<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Parking App' }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optioneel: custom fonts of scripts --}}
    @stack('styles')
</head>

<body class="bg-gray-100 min-h-screen font-sans text-gray-900">

    {{-- Navbar / Header --}}
    <header class="bg-indigo-600 text-white p-4 shadow-md">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Parking App</h1>
            <nav>
                <a href="{{ route('parkingspots.index') }}" class="hover:underline px-2">Parking Spots</a>
            </nav>
        </div>
    </header>

    {{-- Main content --}}
    <main class="py-10">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-200 text-gray-700 p-4 mt-auto text-center">
        &copy; {{ date('Y') }} Parking App. All rights reserved.
    </footer>

    @stack('scripts')
</body>

</html>