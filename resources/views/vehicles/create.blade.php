<x-base-layout>
    <h1 class="text-2xl font-bold mb-4">Add New Vehicle</h1>

    <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf

        {{-- License Plate --}}
        <div>
            <label class="block font-semibold">License Plate</label>
            <input
                type="text"
                name="license_plate"
                value="{{ old('license_plate') }}"
                class="border rounded w-full p-2"
                placeholder="ABC-123"
                required
            >
        </div>

        {{-- Brand --}}
        <div>
            <label class="block font-semibold">Brand</label>
            <input
                type="text"
                name="brand"
                value="{{ old('brand') }}"
                class="border rounded w-full p-2"
                placeholder="Tesla"
                required
            >
        </div>

        {{-- Model --}}
        <div>
            <label class="block font-semibold">Model</label>
            <input
                type="text"
                name="model"
                value="{{ old('model') }}"
                class="border rounded w-full p-2"
                placeholder="Model S"
                required
            >
        </div>

        {{-- Year --}}
        <div>
            <label class="block font-semibold">Year</label>
            <input
                type="number"
                name="year"
                value="{{ old('year') }}"
                class="border rounded w-full p-2"
                placeholder="2020"
                min="1900"
                max="{{ date('Y') + 1 }}"
                required
            >
        </div>

        {{-- Fuel Type --}}
        <div>
            <label class="block font-semibold">Fuel Type</label>
            <select name="fuel_type" class="border rounded w-full p-2" required>
                <option value="">-- Select Fuel Type --</option>
                <option value="petrol" @selected(old('fuel_type') === 'petrol')>Petrol</option>
                <option value="diesel" @selected(old('fuel_type') === 'diesel')>Diesel</option>
                <option value="electric" @selected(old('fuel_type') === 'electric')>Electric</option>
                <option value="hybrid" @selected(old('fuel_type') === 'hybrid')>Hybrid</option>
                <option value="plugin_hybrid" @selected(old('fuel_type') === 'plugin_hybrid')>Plug-in Hybrid</option>
            </select>
        </div>

        {{-- Vehicle Type --}}
        <div>
            <label class="block font-semibold">Vehicle Type</label>
            <select name="vehicle_type" class="border rounded w-full p-2" required>
                <option value="">-- Select Vehicle Type --</option>
                <option value="sedan" @selected(old('vehicle_type') === 'sedan')>Sedan</option>
                <option value="hatchback" @selected(old('vehicle_type') === 'hatchback')>Hatchback</option>
                <option value="suv" @selected(old('vehicle_type') === 'suv')>SUV</option>
                <option value="truck" @selected(old('vehicle_type') === 'truck')>Truck</option>
                <option value="van" @selected(old('vehicle_type') === 'van')>Van</option>
                <option value="motorcycle" @selected(old('vehicle_type') === 'motorcycle')>Motorcycle</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">
            Add Vehicle
        </button>
    </form>
</x-base-layout>
