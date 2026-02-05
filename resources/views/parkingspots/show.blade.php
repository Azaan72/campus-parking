<x-base-layout>
    <div class="container mx-auto px-4 py-8 max-w-3xl bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <h1 class="text-4xl font-bold mb-4 text-gray-900">Parking Spot: {{ $parkingspot->location }}</h1>

        {{-- Attributes --}}
        <div class="space-y-2 mb-6">
            <p><span class="font-semibold">Location:</span> {{ $parkingspot->location }}</p>
            <p><span class="font-semibold">Type:</span> {{ ucfirst($parkingspot->type) }}</p>
            <p><span class="font-semibold">Status:</span> {{ ucfirst($parkingspot->status) }}</p>
            <p><span class="font-semibold">Vehicle Fuel Type:</span> {{ ucfirst(str_replace('_', ' ', $parkingspot->vehicle_fuel_type)) }}</p>
        </div>

        {{-- Actions --}}
        <div class="flex space-x-4 mb-6">
            <a href="{{ route('parkingspots.edit', $parkingspot->id) }}"
                class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
                Bewerken
            </a>

            <form method="POST" action="{{ route('parkingspots.destroy', $parkingSpot->id) }}" onsubmit="return confirm('Weet je zeker dat je deze parking spot wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200">
                    Verwijderen
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <a href="{{ route('parkingspots.index') }}"
            class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
            ← Terug naar alle Parking Spots
        </a>
    </div>
</x-base-layout>