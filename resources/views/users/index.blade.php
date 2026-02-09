<x-base-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Users</h1>
            <a href="{{ route('users.create') }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add New User
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Users Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Role</th>
                        <th class="px-4 py-2 border-b">Phone</th>
                        <th class="px-4 py-2 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">
                                {{ $user->firstname }}
                                @if($user->prefix)
                                    {{ $user->prefix }}
                                @endif
                                {{ $user->lastname }}
                            </td>

                            <td class="px-4 py-2 border-b">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-2 border-b capitalize">
                                {{ $user->role }}
                            </td>

                            <td class="px-4 py-2 border-b">
                                {{ $user->phone_number }}
                            </td>

                            <td class="px-4 py-2 border-b text-center space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');"
                                >
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
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>
