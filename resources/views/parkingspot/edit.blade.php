<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Feature bewerken</h1>

        <form action="{{ route('features.update', $feature->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="feature_name" class="block font-semibold mb-1">Feature Name</label>
                <input type="text" name="feature_name" id="feature_name" value="{{ $feature->feature_name }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

           <div class="text-center">
                <button type="submit"
                    class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition" 
                    onclick="return confirm('Weet je zeker dat je deze feature wilt bewerken?')">
                    Feature bewerken
                </button>
            </div>
        </form>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</x-base-layout>