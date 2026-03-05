<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Services\OpenStreetMapService;
use App\Services\OpenRouteService;
use App\Services\OpenMeteoService;

class MapController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('map.index', compact('locations'));
    }

    public function route(Request $request)
    {
        $request->validate([
            'address'     => 'required|string',
            'location_id' => 'required|exists:locations,id',
            'arrival'     => 'nullable|date',
        ]);

        // 1. Geocode startadres
        $osm   = new OpenStreetMapService();
        $start = $osm->geocode($request->address);

        if (empty($start)) {
            return response()->json(['error' => 'Startadres niet gevonden.'], 422);
        }

        // 2. Haal parkeerplek op
        $location = Location::findOrFail($request->location_id);

        // 3. Bereken route
        $ors   = new OpenRouteService();
        $route = $ors->getRoute(
            $start['lat'],
            $start['lng'],
            $location->latitude,
            $location->longitude
        );

        if (empty($route)) {
            return response()->json(['error' => 'Route kon niet berekend worden.'], 422);
        }

        // 4. Haal weer op (als aankomsttijd meegegeven)
        $weather = [];
        if ($request->arrival) {
            $meteo   = new OpenMeteoService();
            $weather = $meteo->getForecastForHour(
                $location->latitude,
                $location->longitude,
                $request->arrival
            );
        }

        return response()->json([
            'start'    => $start,
            'route'    => $route,
            'weather'  => $weather,
            'location' => [
                'name' => $location->location_name,
                'lat'  => $location->latitude,
                'lng'  => $location->longitude,
                'type' => $location->type,
            ],
        ]);
    }
}
