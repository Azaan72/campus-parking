<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $title = 'Reservations';
        $reservations = Reservation::all();
        return view('reservations.index', compact('title', 'reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'status_of_reservation' => $request->input('status_of_reservation'),
            'date_time' => $request->input('date_time'),
            'type_reservation' => $request->input('type_reservation'),
            'user_id' => $request->input('user_id'),
            'parking_spot_id' => $request->input('parking_spot_id'),
            'vehicle_id' => $request->input('vehicle_id'),
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation succesvol aangemaakt.');
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status_of_reservation' => $request->input('status_of_reservation'),
            'date_time' => $request->input('date_time'),
            'type_reservation' => $request->input('type_reservation'),
            'user_id' => $request->input('user_id'),
            'parking_spot_id' => $request->input('parking_spot_id'),
            'vehicle_id' => $request->input('vehicle_id'),
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Reservation succesvol bijgewerkt.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation succesvol verwijderd.');
    }

}
