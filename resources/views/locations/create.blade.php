<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Add New Location</h1>

        <form action="{{ route('locations.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Location Name --}}
            <div>
                <label for="location_name" class="block text-sm font-medium text-gray-700">Location Name</label>
                <input type="text" name="location_name" id="location_name" required
                       value="{{ old('location_name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Latitude --}}
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" required
                       value="{{ old('latitude') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Longitude --}}
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" required
                       value="{{ old('longitude') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Type (nullable) --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type (optional)</label>
                <select name="type" id="type"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" selected>— None —</option>
                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Free</option>
                    <option value="paid" {{ old('type') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="permit" {{ old('type') == 'permit' ? 'selected' : '' }}>Permit</option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Create Location
                </button>
            </div>
        </form>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mt-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-base-layout>