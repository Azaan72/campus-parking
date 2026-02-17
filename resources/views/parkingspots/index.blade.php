<x-base-layout>
<form method="GET" action="{{ route('parkingspots.index') }}">
    <select name="type" onchange="this.form.submit()">
        <option value="">Alle types</option>
        <option value="normal"   {{ $type == 'normal'   ? 'selected' : '' }}>Normal</option>
        <option value="electric" {{ $type == 'electric' ? 'selected' : '' }}>Elektric</option>
        <option value="disabled" {{ $type == 'disabled' ? 'selected' : '' }}>Disabled</option>
        <option value="compact"  {{ $type == 'compact'  ? 'selected' : '' }}>Compact</option>
    </select>
</form>

    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Parking Spots</h1>
            <a href="{{ route('parkingspots.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add New Parking Spot
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
        @endif

        {{-- Parking Spots Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">Location</th>
                        <th class="px-4 py-2 border-b">Type</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b">Vehicle Fuel Type</th>
                        <th class="px-4 py-2 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($parkingspots as $spot)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $spot->location }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $spot->type }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $spot->status }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $spot->vehicle_fuel_type }}</td>
                        <td class="px-4 py-2 border-b text-center space-x-2">
                            <a href="{{ route('parkingspots.edit', $spot->id) }}"
                                class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('parkingspots.destroy', $spot->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Weet je zeker dat je deze parking spot wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                            No parking spots found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>