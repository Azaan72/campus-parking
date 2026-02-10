<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $title = 'Vehicles';
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('title', 'vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    } 

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(VehicleStoreRequest $request)
    {
        $vehicle = Vehicle::create([
            'license_plate' => $request->input('license_plate'),
            'model' => $request->input('model'),
            'brand' => $request->input('brand'),
            'year' => $request->input('year'),
            'fuel_type' => $request->input('fuel_type'),
            'vehicle_type' => $request->input('vehicle_type'),
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle succesvol aangemaakt.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $vehicle->update([
            'license_plate' => $request->input('license_plate'),
            'model' => $request->input('model'),
            'brand' => $request->input('brand'),
            'year' => $request->input('year'),
            'fuel_type' => $request->input('fuel_type'),
            'vehicle_type' => $request->input('vehicle_type'),
        ]);

        return redirect()->route('vehicles.show', $vehicle)
            ->with('success', 'Vehicle succesvol bijgewerkt.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle succesvol verwijderd.');
    }

}
