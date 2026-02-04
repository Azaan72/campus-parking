<?php

namespace App\Http\Controllers;

use App\Models\Parkingspot;
use Illuminate\Http\Request;

class ParkingspotController extends Controller
{
    public function index()
    {
        $title = 'Parking Spots';
        $parkingspot = Parkingspot::all();
        return view('parkingspots.index', compact('title', 'parkingspots'));
    }

    public function show($id)
    {
        $parkingspot = Parkingspot::findOrFail($id);

        return view('parkingspot.show', compact('parkingspot'));
    }
}
