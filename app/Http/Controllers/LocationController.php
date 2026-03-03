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

        $location = Location::when($type, fn($q) => $q->byType($type))->get();

        return view('locations.index', compact('title', 'location', 'type'));
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
            'location_name' => $request->input('location_name'),
        ]);
    

        return redirect()->route('locations.index')
            ->with('success', 'Location succesvol aangemaakt.');
    }

    // UPDATE
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $location->update([
            'location_name' => $request->input('location_name'),
        ]);


        return redirect()->route('locations.show', $location)
            ->with('success', 'Location succesvol bijgewerkt.');
    }

    public function edit(Location $location)
    {

        return view('locations.edit')->with('status', 'Location succesvol bijgewerkt.')->with('location', $location);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        return redirect()->route('locations.index');
    }
}
