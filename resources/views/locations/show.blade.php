<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Location Details</h1>

        <div class="space-y-4">

            <div>
                <span class="font-semibold text-gray-700">Location Name:</span>
                <span class="text-gray-900">{{ $location->city }}</span>
            </div>

        {{-- Buttons --}}
        <div class="mt-6 flex justify-between">
            <a href="{{ route('locations.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Back
            </a>

            <a href="{{ route('locations.edit', $location) }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Edit
            </a>
        </div>
    </div>
</x-base-layout>
