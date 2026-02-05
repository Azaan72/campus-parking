<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingSpotStoreRequest;
use App\Http\Requests\ParkingSpotUpdateRequest;
use App\Models\Parkingspot;
use Illuminate\Http\Request;

class ParkingspotController extends Controller
{
    public function index()
    {
        $title = 'Parking Spots';
        $parkingspots = Parkingspot::all();
        return view('parkingspots.index', compact('title', 'parkingspots'));
    }

    public function show(Parkingspot $parkingspot)
    {

        return view('parkingspots.show', compact('parkingspot'));
    }

    public function create()
    {
        return view('parkingspots.create');
    }

    // STORE
    public function store(ParkingSpotStoreRequest $request)
    {
        $parkingspot = Parkingspot::create([
            'location' => $request->input('location'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'vehicle_fuel_type' => $request->input('vehicle_fuel_type'),
        ]);

        return redirect()->route('parkingspots.index')
            ->with('success', 'Parking spot succesvol aangemaakt.');
    }

    // UPDATE
    public function update(ParkingSpotUpdateRequest $request, Parkingspot $parkingspot)
    {
        $parkingspot->update([
            'location' => $request->input('location'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'vehicle_fuel_type' => $request->input('vehicle_fuel_type'),
        ]);


        return redirect()->route('parkingspots.show', $parkingspot)
            ->with('success', 'Parking spot succesvol bijgewerkt.');
    }

    public function edit(Parkingspot $parkingspot)
    {

        return view('parkingspots.edit')->with('status', 'Parkingspot succesvol bijgewerkt.')->with('parkingspot', $parkingspot);
    }

    public function destroy($id)
    {
        $parkingspots = Parkingspot::findOrFail($id);

        $parkingspots->delete();

        return redirect()->route('parkingspots.index');
    }
}
