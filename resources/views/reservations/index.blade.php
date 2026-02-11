<x-base-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Reservations</h1>
            <a href="{{ route('reservations.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Add New Reservation
            </a>
        </div>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Reservations Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-4 py-2 border-b">Date & Time</th>
                        <th class="px-4 py-2 border-b">Parking Spot</th>
                        <th class="px-4 py-2 border-b">Vehicle</th>
                        <th class="px-4 py-2 border-b">User</th>
                        <th class="px-4 py-2 border-b">Type</th>
                        <th class="px-4 py-2 border-b">Status</th>
                        <th class="px-4 py-2 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $reservation)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">
                                {{ \Carbon\Carbon::parse($reservation->date_time)->format('d-m-Y H:i') }}
                            </td>

                            <td class="px-4 py-2 border-b">
                                {{ $reservation->parkingSpot->location ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-2 border-b">
                                {{ $reservation->vehicle->license_plate ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-2 border-b">
                                {{ $reservation->user->name ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-2 border-b capitalize">
                                {{ $reservation->type_reservation }}
                            </td>

                            <td class="px-4 py-2 border-b capitalize">
                                {{ $reservation->status_of_reservation }}
                            </td>

                            <td class="px-4 py-2 border-b text-center space-x-2">
                                <a href="{{ route('reservations.show', $reservation) }}"
                                   class="text-indigo-600 hover:underline">
                                    View
                                </a>

                                <a href="{{ route('reservations.edit', $reservation) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('reservations.destroy', $reservation) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Weet je zeker dat je deze reservatie wilt verwijderen?');">
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
                                No reservations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>
