<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Location bewerken</h1>

        <form action="{{ route('locations.update', $location) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <forM action="{{ route('locations.update', $location) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">Location Name</label>
                    <input type="text" name="city" id="city" required value="{{ old('city', $location->city) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition"
                        onclick="return confirm('Weet je zeker dat je deze location wilt bewerken?')">
                    Location bijwerken
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
