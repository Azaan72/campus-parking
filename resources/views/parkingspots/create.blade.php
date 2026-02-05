<x-base-layout>
    <h1 class="text-2xl font-bold mb-4">Add New Parking Spot</h1>

    <form action="{{ route('parkingspots.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf

        {{-- Location --}}
        <div>
            <label class="block font-semibold">Location</label>
            <input type="text" name="location" class="border rounded w-full p-2" placeholder="Verdieping -1, Zone A, P1" required>
        </div>

        {{-- Type --}}
        <div>
            <label class="block font-semibold">Type</label>
            <select name="type" class="border rounded w-full p-2" required>
                <option value="">-- Select Type --</option>
                <option value="normal">Normal</option>
                <option value="compact">Compact</option>
                <option value="disabled">Disabled</option>
                <option value="electric">Electric</option>
            </select>
        </div>

        {{-- Status --}}
        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="border rounded w-full p-2" required>
                <option value="">-- Select Status --</option>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="reserved">Reserved</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        {{-- Vehicle Fuel Type --}}
        <div>
            <label class="block font-semibold">Allowed Vehicle Fuel Type</label>
            <select name="vehicle_fuel_type" class="border rounded w-full p-2" required>
                <option value="">-- Select Fuel Type --</option>
                <option value="petrol">Petrol</option>
                <option value="diesel">Diesel</option>
                <option value="electric">Electric</option>
                <option value="hybrid">Hybrid</option>
                <option value="plugin_hybrid">Plug-in Hybrid</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Add Parking Spot</button>
    </form>
</x-base-layout>
