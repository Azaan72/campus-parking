<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class MapController extends Controller
{
    public function index()
    {
        $locations = Location::all(); // haal alle locaties op
        return view('map.index', compact('locations')); // stuur ze mee naar de view
    }
}
