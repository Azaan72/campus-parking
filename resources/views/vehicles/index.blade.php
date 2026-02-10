<x-base-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Vehicles</h1>
            <a href="{{ route('vehicles.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add New Vehicle
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Vehicles Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">License Plate</th>
                        <th class="px-4 py-2 border-b">Brand</th>
                        <th class="px-4 py-2 border-b">Model</th>
                        <th class="px-4 py-2 border-b">Year</th>
                        <th class="px-4 py-2 border-b">Fuel Type</th>
                        <th class="px-4 py-2 border-b">Vehicle Type</th>
                        <th class="px-4 py-2 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $vehicle->license_plate }}</td>
                            <td class="px-4 py-2 border-b">{{ $vehicle->brand }}</td>
                            <td class="px-4 py-2 border-b">{{ $vehicle->model }}</td>
                            <td class="px-4 py-2 border-b">{{ $vehicle->year }}</td>
                            <td class="px-4 py-2 border-b capitalize">{{ $vehicle->fuel_type }}</td>
                            <td class="px-4 py-2 border-b capitalize">{{ $vehicle->vehicle_type }}</td>
                            <td class="px-4 py-2 border-b text-center space-x-2">
                                <a href="{{ route('vehicles.show', $vehicle) }}"
                                   class="text-indigo-600 hover:underline">
                                    View
                                </a>

                                <a href="{{ route('vehicles.edit', $vehicle) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('vehicles.destroy', $vehicle) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Weet je zeker dat je dit voertuig wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No vehicles found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>
