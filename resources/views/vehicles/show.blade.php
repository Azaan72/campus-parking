<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Vehicle details</h1>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            {{-- License Plate --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">License Plate</span>
                <span>{{ $vehicle->license_plate }}</span>
            </div>

            {{-- Brand --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">Brand</span>
                <span>{{ $vehicle->brand }}</span>
            </div>

            {{-- Model --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">Model</span>
                <span>{{ $vehicle->model }}</span>
            </div>

            {{-- Year --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">Year</span>
                <span>{{ $vehicle->year }}</span>
            </div>

            {{-- Fuel Type --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">Fuel Type</span>
                <span class="capitalize">{{ $vehicle->fuel_type }}</span>
            </div>

            {{-- Vehicle Type --}}
            <div class="flex justify-between border-b pb-2">
                <span class="font-semibold">Vehicle Type</span>
                <span class="capitalize">{{ $vehicle->vehicle_type }}</span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ route('vehicles.edit', $vehicle) }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Edit
            </a>

            <form action="{{ route('vehicles.destroy', $vehicle) }}"
                  method="POST"
                  onsubmit="return confirm('Weet je zeker dat je dit voertuig wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                    Delete
                </button>
            </form>

            <a href="{{ route('vehicles.index') }}"
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                Back to list
            </a>
        </div>
    </div>
</x-base-layout>
