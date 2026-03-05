<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Location Details</h1>

        <div class="space-y-4">

            {{-- Location Name --}}
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-40">Location Name:</span>
                <span class="text-gray-900">{{ $location->location_name }}</span>
            </div>

            {{-- Latitude --}}
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-40">Latitude:</span>
                <span class="text-gray-900">{{ $location->latitude }}</span>
            </div>

            {{-- Longitude --}}
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-40">Longitude:</span>
                <span class="text-gray-900">{{ $location->longitude }}</span>
            </div>

            {{-- Type with badge --}}
            <div class="flex items-center">
                <span class="font-semibold text-gray-700 w-40">Type:</span>
                @if($location->type === 'free')
                    <span class="px-2 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">Free</span>
                @elseif($location->type === 'paid')
                    <span class="px-2 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">Paid</span>
                @elseif($location->type === 'permit')
                    <span class="px-2 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">Permit</span>
                @else
                    <span class="text-gray-500">—</span>
                @endif
            </div>

        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex justify-between">
            <a href="{{ route('locations.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Back
            </a>
            @auth
            <a href="{{ route('locations.edit', $location) }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Edit
            </a>
            @endauth
        </div>
    </div>
</x-base-layout>