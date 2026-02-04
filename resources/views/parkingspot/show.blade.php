<x-base-layout>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $feature->feature_name }}</h1>


        <a href="{{ route('features.edit', $feature->id) }}"
            class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
            Bewerken
        </a>


        <form method="post" action="{{ route('features.destroy', $feature->id) }}">

            @csrf
            @method('DELETE')
            <button type="submit">Verwijderen</button>
        </form>


        <a href="{{ route('features.index') }}" class="inline-block mt-6 text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
            ← Terug naar alle Features
        </a>
    </div>
</x-base-layout>