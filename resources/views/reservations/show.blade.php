<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Reservation Details</h1>

        <div class="space-y-4">

            {{-- Date & Time --}}
            <div>
                <span class="font-semibold">Date & Time:</span>
                <p>{{ \Carbon\Carbon::parse($reservation->date_time)->format('d-m-Y H:i') }}</p>
            </div>

            {{-- Parking Spot --}}
            <div>
                <span class="font-semibold">Parking Spot:</span>
                <p>
                    {{ $reservation->parkingSpot->location ?? '-' }}
                    ({{ $reservation->parkingSpot->type ?? '-' }})
                </p>
            </div>

            {{-- Vehicle --}}
            <div>
                <span class="font-semibold">Vehicle:</span>
                <p>
                    {{ $reservation->vehicle->license_plate ?? '-' }}
                    - {{ $reservation->vehicle->brand ?? '' }}
                    {{ $reservation->vehicle->model ?? '' }}
                    <br>
                    <span class="text-sm text-gray-600">
                        Status: {{ $reservation->vehicle->status ?? '-' }}
                    </span>
                </p>
            </div>

            {{-- User --}}
            <div>
                <span class="font-semibold">User:</span>
                <p>{{ $reservation->user->name ?? '-' }}</p>
            </div>

            {{-- Reservation Type --}}
            <div>
                <span class="font-semibold">Reservation Type:</span>
                <p>{{ ucfirst($reservation->type_reservation) }}</p>
            </div>

            {{-- Status --}}
            <div>
                <span class="font-semibold">Status:</span>
                <p>
                    <span class="
                        px-3 py-1 rounded text-white text-sm
                        @if($reservation->status_of_reservation === 'confirmed') bg-green-500
                        @elseif($reservation->status_of_reservation === 'pending') bg-yellow-500
                        @elseif($reservation->status_of_reservation === 'cancelled') bg-red-500
                        @endif
                    ">
                        {{ ucfirst($reservation->status_of_reservation) }}
                    </span>
                </p>
            </div>

        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex justify-between">
            <a href="{{ route('reservations.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                Back
            </a>

            <a href="{{ route('reservations.edit', $reservation) }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Edit
            </a>
        </div>
    </div>
</x-base-layout>
