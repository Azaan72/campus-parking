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

    public function show($id)
    {
        $parkingspots = Parkingspot::findOrFail($id);

        return view('parkingspots.show', compact('parkingspots'));
    }

    public function create()
    {
        return view('parkingspots.create');
    }

    public function store(ParkingSpotStoreRequest $request, Parkingspot $parkingspots)
    {
        $parkingspots = new Parkingspot();
        $parkingspots->parkingspot_name = $request->input('parkingspot_name');
        $parkingspots->save();

        return redirect()->route('parkingspots.index');
    }

    public function update(ParkingSpotUpdateRequest $request, Parkingspot $parkingspots)
    {

        $parkingspots->parkingspot_name = $request->input('parkingspot_name');
        $parkingspots->save();

        return redirect()->route('parkingspots.show', ['parkingspots' => $parkingspots->id]);
    }

    public function edit($id)
    {
        $parkingspots = Parkingspot::findOrFail($id);

        return view('parkingspots.edit')->with('status', 'Parkingspot succesvol bijgewerkt.')->with('parkingspots', $parkingspots);
    }

    public function destroy($id)
    {
        $parkingspots = Parkingspot::findOrFail($id);

        $parkingspots->delete();

        return redirect()->route('parkingspots.index');
    }
}
