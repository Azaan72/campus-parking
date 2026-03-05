<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class StatistiekenController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('parkingSpot')->get();

        $totalReservations     = 0;
        $activeReservations    = 0;
        $cancelledReservations = 0;
        $perZone               = [];
        $perTijdslot           = [];

        foreach ($reservations as $reservering) {
            $totalReservations++;

            if ($reservering->status_of_reservation == 'active' || $reservering->status_of_reservation == 'confirmed') {
                $activeReservations++;
            }

            if ($reservering->status_of_reservation == 'cancelled') {
                $cancelledReservations++;
            }

            $locatie = $reservering->parkingSpot->location;

            if (isset($perZone[$locatie])) {
                $perZone[$locatie] = $perZone[$locatie] + 1;
            } else {
                $perZone[$locatie] = 1;
            }

            $uur = $reservering->date_time->format('H:00');

            if (isset($perTijdslot[$uur])) {
                $perTijdslot[$uur] = $perTijdslot[$uur] + 1;
            } else {
                $perTijdslot[$uur] = 1;
            }
        }

        // Sorteer zones van meest naar minst gebruikt
        arsort($perZone);

        // Sorteer tijdsloten op volgorde van de dag
        ksort($perTijdslot);

        return view('statistieken.index', compact(
            'totalReservations',
            'activeReservations',
            'cancelledReservations',
            'perZone',
            'perTijdslot'
        ));
    }
}
