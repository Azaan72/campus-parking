<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">User bewerken</h1>

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Firstname --}}
            <div>
                <label class="block font-semibold mb-1">First name</label>
                <input
                    type="text"
                    name="firstname"
                    value="{{ $user->firstname }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Prefix --}}
            <div>
                <label class="block font-semibold mb-1">Prefix</label>
                <input
                    type="text"
                    name="prefix"
                    value="{{ $user->prefix }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- Lastname --}}
            <div>
                <label class="block font-semibold mb-1">Last name</label>
                <input
                    type="text"
                    name="lastname"
                    value="{{ $user->lastname }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Role --}}
            <div>
                <label class="block font-semibold mb-1">Role</label>
                <select name="role" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Select Role --</option>
                    <option value="user"
                        @if($user->role === 'user') selected @endif
                    >User</option>
                    <option value="admin"
                        @if($user->role === 'admin') selected @endif
                    >Admin</option>
                </select>
            </div>

            {{-- Email --}}
            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
            </div>

      


            {{-- Phone number --}}
            <div>
                <label class="block font-semibold mb-1">Phone number</label>
                <input
                    type="text"
                    name="phone_number"
                    value="{{ $user->phone_number }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- Streetname --}}
            <div>
                <label class="block font-semibold mb-1">Street name</label>
                <input
                    type="text"
                    name="streetname"
                    value="{{ $user->streetname }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- House number --}}
            <div>
                <label class="block font-semibold mb-1">House number</label>
                <input
                    type="text"
                    name="house_number"
                    value="{{ $user->house_number }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- Zipcode --}}
            <div>
                <label class="block font-semibold mb-1">Zipcode</label>
                <input
                    type="text"
                    name="zipcode"
                    value="{{ $user->zipcode }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- City --}}
            <div>
                <label class="block font-semibold mb-1">City</label>
                <input
                    type="text"
                    name="city"
                    value="{{ $user->city }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- Country --}}
            <div>
                <label class="block font-semibold mb-1">Country</label>
                <input
                    type="text"
                    name="country"
                    value="{{ $user->country }}"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                >
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button
                    type="submit"
                    class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition"
                    onclick="return confirm('Weet je zeker dat je deze gebruiker wilt bewerken?')"
                >
                    User bewerken
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
