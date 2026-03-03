<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Parking locations';
        $type = $request->get('type');

        // Fetch all locations (or filter by type if needed)
        $locations = Location::when($type, fn($q) => $q->byType($type))->get();

        // Pass $locations to the view (not $location)
        return view('locations.index', compact('title', 'locations', 'type'));
    }

    public function show(Location $location)
    {

        return view('locations.show', compact('location'));
    }

    public function create()
    {
        return view('locations.create');
    }

    // STORE
    public function store(LocationStoreRequest $request)
    {
        $location = Location::create([
            'location' => $request->input('location'),
        ]);


        return redirect()->route('locations.index')
            ->with('success', 'Location succesvol aangemaakt.');
    }

    // UPDATE
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $location->update([
            'location' => $request->input('location'),
        ]);


        return redirect()->route('locations.show', $location)
            ->with('success', 'Location succesvol bijgewerkt.');
    }

    public function edit(Location $location)
    {

        return view('locations.edit')->with('status', 'Location succesvol bijgewerkt.')->with('location', $location);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Location succesvol verwijderd.');
    }
}
