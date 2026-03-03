<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campus Parking Route</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); min-height:100vh; padding:20px; }
        .container { max-width:1200px; margin:0 auto; background:white; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.3); overflow:hidden; }
        .header { background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; padding:30px; text-align:center; }
        .content { padding:30px; }
        .controls { display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:20px; }
        .controls input, .controls select { width:100%; padding:15px; border:2px solid #e0e0e0; border-radius:10px; font-size:1em; }
        .controls button { grid-column:1/-1; padding:15px; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600; }
        #map { height:500px; border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.1); }
        .parking-badge { display:inline-block; margin-top:6px; padding:4px 10px; border-radius:20px; font-size:0.78em; font-weight:600; }
        .badge-free { background:#d4edda; color:#155724; }
        .badge-paid { background:#fff3cd; color:#856404; }
        .badge-permit { background:#cce5ff; color:#004085; }
        .badge-hidden { display:none; }
        @media(max-width:768px){ .controls{grid-template-columns:1fr;} }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🅿️ Campus Parking Route Planner</h1>
        <p>Find the fastest route to your parking spot</p>
    </div>

    <div class="content">
        <div class="controls">
            <div>
                <label>📍 Starting Location</label>
                <input type="text" id="startLocation" placeholder="Enter address">
            </div>

            <div>
                <label>🅿️ Parking Destination</label>
                <select id="endLocation" onchange="onParkingSelect()">
                    <option value="">— Choose parking lot —</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}"
                                data-lat="{{ $loc->latitude }}"
                                data-lng="{{ $loc->longitude }}"
                                data-type="{{ $loc->type }}">
                            {{ $loc->location_name }}
                        </option>
                    @endforeach
                </select>
                <span id="parkingBadge" class="parking-badge badge-hidden"></span>
            </div>

            <button onclick="calculateRoute()">🗺️ Get Directions</button>
        </div>

        <div id="map"></div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([52.1,5.1],13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{ attribution:'© OpenStreetMap' }).addTo(map);

    const ORS_API_KEY = "eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6IjE1OTFjMDFlZDUyYjQzOWNiZGI2MjQxMDYxODQyYmUxIiwiaCI6Im11cm11cjY0In0=";

    let startMarker,endMarker,routeLine;

    function onParkingSelect(){
        const sel = document.getElementById('endLocation');
        const badge = document.getElementById('parkingBadge');
        const opt = sel.options[sel.selectedIndex];
        const type = opt.dataset.type;

        badge.className='parking-badge badge-hidden';
        badge.textContent='';

        if(type==='free'){ badge.className='parking-badge badge-free'; badge.textContent='✅ Free'; }
        if(type==='paid'){ badge.className='parking-badge badge-paid'; badge.textContent='💰 Paid'; }
        if(type==='permit'){ badge.className='parking-badge badge-permit'; badge.textContent='🔒 Permit'; }
    }

    async function calculateRoute(){
        const startAddress = document.getElementById('startLocation').value;
        const sel = document.getElementById('endLocation');
        const option = sel.options[sel.selectedIndex];

        if(!startAddress || !option.dataset.lat){
            alert("Vul zowel startlocatie als parking in");
            return;
        }

        const geo = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(startAddress)}`);
        const data = await geo.json();
        if(!data.length){ alert("Startadres niet gevonden"); return; }

        const startLat = parseFloat(data[0].lat);
        const startLng = parseFloat(data[0].lon);
        const endLat = parseFloat(option.dataset.lat);
        const endLng = parseFloat(option.dataset.lng);

        if(startMarker) map.removeLayer(startMarker);
        if(endMarker) map.removeLayer(endMarker);
        if(routeLine) map.removeLayer(routeLine);

        startMarker = L.marker([startLat,startLng]).addTo(map);
        endMarker = L.marker([endLat,endLng]).addTo(map);

        const route = await fetch(
            `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${ORS_API_KEY}&start=${startLng},${startLat}&end=${endLng},${endLat}`
        );
        const routeData = await route.json();
        if(routeData.features){
            const coords = routeData.features[0].geometry.coordinates;
            const latlngs = coords.map(c=>[c[1],c[0]]);
            routeLine = L.polyline(latlngs,{color:'#667eea',weight:5}).addTo(map);
            map.fitBounds(routeLine.getBounds());
        }
    }
</script>
</body>
</html>