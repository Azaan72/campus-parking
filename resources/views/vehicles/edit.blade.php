<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Vehicle bewerken</h1>

        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- License Plate --}}
            <div>
                <label for="license_plate" class="block font-semibold mb-1">License Plate</label>
                <input
                    type="text"
                    name="license_plate"
                    id="license_plate"
                    value="{{ old('license_plate', $vehicle->license_plate) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Brand --}}
            <div>
                <label for="brand" class="block font-semibold mb-1">Brand</label>
                <input
                    type="text"
                    name="brand"
                    id="brand"
                    value="{{ old('brand', $vehicle->brand) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Model --}}
            <div>
                <label for="model" class="block font-semibold mb-1">Model</label>
                <input
                    type="text"
                    name="model"
                    id="model"
                    value="{{ old('model', $vehicle->model) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Year --}}
            <div>
                <label for="year" class="block font-semibold mb-1">Year</label>
                <input
                    type="number"
                    name="year"
                    id="year"
                    value="{{ old('year', $vehicle->year) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    min="1900"
                    max="{{ date('Y') + 1 }}"
                    required
                >
            </div>

            {{-- Fuel Type --}}
            <div>
                <label for="fuel_type" class="block font-semibold mb-1">Fuel Type</label>
                <select
                    name="fuel_type"
                    id="fuel_type"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
                    <option value="">-- Select Fuel Type --</option>
                    <option value="petrol" @selected(old('fuel_type', $vehicle->fuel_type) === 'petrol')>Petrol</option>
                    <option value="diesel" @selected(old('fuel_type', $vehicle->fuel_type) === 'diesel')>Diesel</option>
                    <option value="electric" @selected(old('fuel_type', $vehicle->fuel_type) === 'electric')>Electric</option>
                    <option value="hybrid" @selected(old('fuel_type', $vehicle->fuel_type) === 'hybrid')>Hybrid</option>
                    <option value="plugin_hybrid" @selected(old('fuel_type', $vehicle->fuel_type) === 'plugin_hybrid')>Plug-in Hybrid</option>
                </select>
            </div>

            {{-- Vehicle Type --}}
            <div>
                <label for="vehicle_type" class="block font-semibold mb-1">Vehicle Type</label>
                <select
                    name="vehicle_type"
                    id="vehicle_type"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
                    <option value="">-- Select Vehicle Type --</option>
                    <option value="sedan" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'sedan')>Sedan</option>
                    <option value="hatchback" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'hatchback')>Hatchback</option>
                    <option value="suv" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'suv')>SUV</option>
                    <option value="truck" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'truck')>Truck</option>
                    <option value="van" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'van')>Van</option>
                    <option value="motorcycle" @selected(old('vehicle_type', $vehicle->vehicle_type) === 'motorcycle')>Motorcycle</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button
                    type="submit"
                    class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition"
                    onclick="return confirm('Weet je zeker dat je dit voertuig wilt bewerken?')"
                >
                    Vehicle bewerken
                </button>
            </div>
        </form>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mt-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-base-layout>
