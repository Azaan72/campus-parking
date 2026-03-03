<x-base-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Locations</h1>
            <a href="{{ route('locations.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add New Location
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error message --}}
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('citys.destroy', $city) }}"
              method="POST"
              class="inline-block"
              onsubmit="return confirm('Weet je zeker dat je deze city wilt verwijderen?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">
                Delete
            </button>
        </form>
    </div>
</x-base-layout>