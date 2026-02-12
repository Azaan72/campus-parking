<x-base-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Add New Reservation</h1>

        <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Date & Time --}}
            <div>
                <label class="block font-semibold mb-1">Date & Time</label>
                <input type="datetime-local"
                       name="date_time"
                       value="{{ old('date_time') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       required>
            </div>

            {{-- Parking Spot Dropdown --}}
            <div>
                <label class="block font-semibold mb-1">Parking Spot</label>
                <select name="parking_spot_id"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="">-- Select Parking Spot --</option>
                    @foreach($parkingSpots as $spot)
                        <option value="{{ $spot->id }}"
                            @selected(old('parking_spot_id') == $spot->id)>
                            {{ $spot->location }} ({{ $spot->type }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Vehicle Dropdown --}}
            <div>
                <label class="block font-semibold mb-1">Vehicle (License Plate)</label>
                <select name="vehicle_id"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}"
                            @selected(old('vehicle_id') == $vehicle->id)>
                            {{ $vehicle->license_plate }} - {{ $vehicle->brand }} {{ $vehicle->model }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- User Dropdown --}}
            <div>
                <label class="block font-semibold mb-1">User</label>
                <select name="user_id"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            @selected(old('user_id') == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Reservation Type --}}
            <div>
                <label class="block font-semibold mb-1">Reservation Type</label>
                <select name="type_reservation"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="">-- Select Type --</option>
                    <option value="hourly" @selected(old('type_reservation') === 'hourly')>Hourly</option>
                    <option value="daily" @selected(old('type_reservation') === 'daily')>Daily</option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status_of_reservation"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="">-- Select Status --</option>
                    <option value="pending" @selected(old('status_of_reservation') === 'pending')>Pending</option>
                    <option value="confirmed" @selected(old('status_of_reservation') === 'confirmed')>Confirmed</option>
                    <option value="cancelled" @selected(old('status_of_reservation') === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Create Reservation
                </button>
            </div>
        </form>

        {{-- Validation Errors --}}
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
