<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Parking Spot bewerken</h1>

        <form action="{{ route('parkingspots.update', $parkingspot->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Location --}}
            <div>
                <label for="location" class="block font-semibold mb-1">Location</label>
                <input type="text" name="location" id="location" value="{{ $parkingspot->location }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block font-semibold mb-1">Type</label>
                <select name="type" id="type" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">-- Select Type --</option>
                    <option value="normal"
                        @if($parkingspot->type === 'normal') selected @endif
                        >Normal</option>
                    <option value="compact"
                        @if($parkingspot->type === 'compact') selected @endif
                        >Compact</option>
                    <option value="disabled"
                        @if($parkingspot->type === 'disabled') selected @endif
                        >Disabled</option>
                    <option value="electric"
                        @if($parkingspot->type === 'electric') selected @endif
                        >Electric</option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-semibold mb-1">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">-- Select Status --</option>
                    <option value="available"
                        @if($parkingspot->status === 'available') selected @endif
                        >Available</option>
                    <option value="occupied"
                        @if($parkingspot->status === 'occupied') selected @endif
                        >Occupied</option>
                    <option value="reserved"
                        @if($parkingspot->status === 'reserved') selected @endif
                        >Reserved</option>
                    <option value="maintenance"
                        @if($parkingspot->status === 'maintenance') selected @endif
                        >Maintenance</option>
                </select>
            </div>

            {{-- Vehicle Fuel Type --}}
            <div>
                <label for="vehicle_fuel_type" class="block font-semibold mb-1">Allowed Vehicle Fuel Type</label>
                <select name="vehicle_fuel_type" id="vehicle_fuel_type" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="">-- Select Fuel Type --</option>
                    <option value="petrol"
                        @if($parkingspot->vehicle_fuel_type === 'petrol') selected @endif
                        >Petrol</option>
                    <option value="diesel"
                        @if($parkingspot->vehicle_fuel_type === 'diesel') selected @endif
                        >Diesel</option>
                    <option value="electric"
                        @if($parkingspot->vehicle_fuel_type === 'electric') selected @endif
                        >Electric</option>
                    <option value="hybrid"
                        @if($parkingspot->vehicle_fuel_type === 'hybrid') selected @endif
                        >Hybrid</option>
                    <option value="plugin_hybrid"
                        @if($parkingspot->vehicle_fuel_type === 'plugin_hybrid') selected @endif
                        >Plug-in Hybrid</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit"
                    class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition"
                    onclick="return confirm('Weet je zeker dat je deze parking spot wilt bewerken?')">
                    Parking Spot bewerken
                </button>
            </div>
        </form>

        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</x-base-layout>