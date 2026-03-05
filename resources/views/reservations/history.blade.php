{{-- resources/views/reservations/history.blade.php --}}
<x-base-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">

        <h1 class="text-3xl font-bold mb-6">Mijn Reserveringen</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($reservations->isEmpty())
            <div class="text-center text-gray-500 py-12">
                Je hebt nog geen reserveringen.
            </div>
        @else
            <div class="space-y-4">
                @foreach($reservations as $reservation)
                    <div class="border border-gray-200 rounded-lg p-5 flex justify-between items-start hover:bg-gray-50">

                        <div class="space-y-1">
                            <p class="font-semibold text-gray-800">
                                📍 {{ $reservation->parkingSpot->location ?? 'Onbekende locatie' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                🕐 {{ \Carbon\Carbon::parse($reservation->date_time)->format('d-m-Y H:i') }}
                            </p>
                            <p class="text-sm text-gray-500">
                                🚗 {{ $reservation->vehicle->license_plate ?? 'Onbekend voertuig' }}
                            </p>
                            <p class="text-sm text-gray-500 capitalize">
                                🏷️ {{ $reservation->type_reservation }}
                            </p>
                        </div>

                        <span @class([
                            'text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap',
                            'bg-green-100 text-green-700' => $reservation->status_of_reservation === 'active',
                            'bg-gray-100 text-gray-500'   => $reservation->status_of_reservation === 'completed',
                            'bg-red-100 text-red-600'     => $reservation->status_of_reservation === 'cancelled',
                        ])>
                            {{ match($reservation->status_of_reservation) {
                                'active'    => 'Actief',
                                'completed' => 'Verlopen',
                                'cancelled' => 'Geannuleerd',
                                default     => ucfirst($reservation->status_of_reservation)
                            } }}
                        </span>

                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $reservations->links() }}
            </div>
        @endif

    </div>
</x-base-layout>