{{-- resources/views/statistieken/index.blade.php --}}
<x-base-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 space-y-8">

        <h1 class="text-3xl font-bold text-gray-900">Statistieken</h1>

        {{-- Totaal statistieken --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow p-6 text-center border border-gray-100">
                <p class="text-4xl font-bold text-indigo-600">{{ $totalReservations }}</p>
                <p class="text-gray-500 mt-2 text-sm font-medium">Totaal reserveringen</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center border border-gray-100">
                <p class="text-4xl font-bold text-green-600">{{ $activeReservations }}</p>
                <p class="text-gray-500 mt-2 text-sm font-medium">Actief / Bevestigd</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 text-center border border-gray-100">
                <p class="text-4xl font-bold text-red-500">{{ $cancelledReservations }}</p>
                <p class="text-gray-500 mt-2 text-sm font-medium">Geannuleerd</p>
            </div>
        </div>

        {{-- Bezetting per zone --}}
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Bezetting per zone</h2>
            @if(empty($perZone))
                <p class="text-gray-400 text-sm">Geen data beschikbaar.</p>
            @else
                <div class="space-y-3">
                    @foreach($perZone as $zone => $count)
                        @php $percentage = $totalReservations > 0 ? round(($count / $totalReservations) * 100) : 0; @endphp
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span class="font-medium">{{ $zone }}</span>
                                <span>{{ $count }} reserveringen ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3">
                                <div class="bg-indigo-500 h-3 rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Bezetting per tijdslot --}}
        <div class="bg-white rounded-xl shadow p-6 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Bezetting per tijdslot</h2>
            @if(empty($perTijdslot))
                <p class="text-gray-400 text-sm">Geen data beschikbaar.</p>
            @else
                @php $max = max($perTijdslot); @endphp
                <div class="space-y-3">
                    @foreach($perTijdslot as $slot => $count)
                        @php $percentage = $max > 0 ? round(($count / $max) * 100) : 0; @endphp
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span class="font-medium">{{ $slot }}</span>
                                <span>{{ $count }} reserveringen</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3">
                                <div class="bg-yellow-400 h-3 rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-base-layout>