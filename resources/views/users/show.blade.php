<x-base-layout>
    <div class="container mx-auto px-4 py-8 max-w-3xl bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <h1 class="text-4xl font-bold mb-4 text-gray-900">
            User: {{ $user->firstname }}
            @if($user->prefix) {{ $user->prefix }} @endif
            {{ $user->lastname }}
        </h1>

        {{-- Attributes --}}
        <div class="space-y-2 mb-6">
            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
            <p><span class="font-semibold">Role:</span> {{ ucfirst($user->role) }}</p>
            <p><span class="font-semibold">Phone Number:</span> {{ $user->phone_number ?? '-' }}</p>
            <p><span class="font-semibold">Street:</span> {{ $user->streetname ?? '-' }} {{ $user->house_number ?? '' }}</p>
            <p><span class="font-semibold">Zipcode:</span> {{ $user->zipcode ?? '-' }}</p>
            <p><span class="font-semibold">City:</span> {{ $user->city ?? '-' }}</p>
            <p><span class="font-semibold">Country:</span> {{ $user->country ?? '-' }}</p>
        </div>

        {{-- Actions --}}
        <div class="flex space-x-4 mb-6">
            <a href="{{ route('users.edit', $user->id) }}"
                class="inline-block text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
                Bewerken
            </a>

            <form method="POST" action="{{ route('users.destroy', $user->id) }}" 
                  onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors duration-200">
                    Verwijderen
                </button>
            </form>
        </div>

        {{-- Back link --}}
        <a href="{{ route('users.index') }}"
            class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
            ← Terug naar alle users
        </a>
    </div>
</x-base-layout>
