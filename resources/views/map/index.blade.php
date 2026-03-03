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
        .controls button { grid-column:1/-1; padding:15px; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600; font-size:1em; }
        .controls button:hover { opacity:.9; }
        #map { height:500px; border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.1); }
        .parking-badge { display:inline-block; margin-top:6px; padding:4px 10px; border-radius:20px; font-size:0.78em; font-weight:600; }
        .badge-free { background:#d4edda; color:#155724; }
        .badge-paid { background:#fff3cd; color:#856404; }
        .badge-permit { background:#cce5ff; color:#004085; }
        .badge-hidden { display:none; }
        @media(max-width:768px){ .controls{grid-template-columns:1fr;} }

        /* ── Route Info Popup ── */
        .popup-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .popup-overlay.active { display: flex; }
        .popup-card {
            background: white;
            border-radius: 20px;
            padding: 36px 40px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.25);
            max-width: 420px;
            width: 90%;
            text-align: center;
            animation: popIn .3s cubic-bezier(.34,1.56,.64,1);
        }
        @keyframes popIn {
            from { transform: scale(0.8); opacity: 0; }
            to   { transform: scale(1);   opacity: 1; }
        }
        .popup-icon { font-size: 3rem; margin-bottom: 10px; }
        .popup-title { font-size: 1.25rem; font-weight: 700; color: #333; margin-bottom: 6px; }
        .popup-destination { font-size: 0.88rem; color: #888; margin-bottom: 24px; }
        .popup-stats { display: flex; gap: 16px; justify-content: center; margin-bottom: 28px; }
        .stat-box {
            flex: 1;
            background: linear-gradient(135deg, #f0f0ff 0%, #f8f0ff 100%);
            border-radius: 14px;
            padding: 20px 14px;
        }
        .stat-value { font-size: 2.1rem; font-weight: 700; color: #667eea; line-height: 1; }
        .stat-unit  { font-size: 1rem; font-weight: 500; color: #764ba2; }
        .stat-label { font-size: 0.75rem; color: #999; margin-top: 6px; text-transform: uppercase; letter-spacing: .06em; }
        .popup-close {
            padding: 13px 40px;
            background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s;
        }
        .popup-close:hover { opacity: .85; }
    </style>
</head>
<body>

<!-- ── Route Info Popup ── -->
<div class="popup-overlay" id="routePopup" onclick="closePopup(event)">
    <div class="popup-card">
        <div class="popup-icon">🗺️</div>
        <div class="popup-title">Route Found!</div>
        <div class="popup-destination" id="popupDestination"></div>
        <div class="popup-stats">
            <div class="stat-box">
                <div class="stat-value" id="popupKm">—</div>
                <div class="stat-unit">km</div>
                <div class="stat-label">Distance</div>
            </div>
            <div class="stat-box">
                <div class="stat-value" id="popupTime">—</div>
                <div class="stat-unit" id="popupTimeUnit">min</div>
                <div class="stat-label">Travel time</div>
            </div>
        </div>
        <button class="popup-close" onclick="document.getElementById('routePopup').classList.remove('active')">
            Got it, show route →
        </button>
    </div>
</div>

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

    let startMarker, endMarker, routeLine;

    function onParkingSelect(){
        const sel   = document.getElementById('endLocation');
        const badge = document.getElementById('parkingBadge');
        const opt   = sel.options[sel.selectedIndex];
        const type  = opt.dataset.type;

        badge.className = 'parking-badge badge-hidden';
        badge.textContent = '';

        if(type === 'free')   { badge.className = 'parking-badge badge-free';   badge.textContent = '✅ Free'; }
        if(type === 'paid')   { badge.className = 'parking-badge badge-paid';   badge.textContent = '💰 Paid'; }
        if(type === 'permit') { badge.className = 'parking-badge badge-permit'; badge.textContent = '🔒 Permit'; }
    }

    function closePopup(e){
        // close only on overlay click (not on the card itself)
        if(e.target === document.getElementById('routePopup')){
            document.getElementById('routePopup').classList.remove('active');
        }
    }

    function showRoutePopup(distanceM, durationS, destinationName){
        const km  = (distanceM / 1000).toFixed(1);

        // Format duration nicely
        const totalMin = Math.round(durationS / 60);
        let timeValue, timeUnit;
        if(totalMin >= 60){
            const h   = Math.floor(totalMin / 60);
            const m   = totalMin % 60;
            timeValue = m > 0 ? `${h}h ${m}` : `${h}`;
            timeUnit  = m > 0 ? 'hr min' : 'hr';
        } else {
            timeValue = totalMin;
            timeUnit  = 'min';
        }

        document.getElementById('popupKm').textContent       = km;
        document.getElementById('popupTime').textContent     = timeValue;
        document.getElementById('popupTimeUnit').textContent = timeUnit;
        document.getElementById('popupDestination').textContent = `📍 To: ${destinationName}`;
        document.getElementById('routePopup').classList.add('active');
    }

    async function calculateRoute(){
        const startAddress = document.getElementById('startLocation').value;
        const sel    = document.getElementById('endLocation');
        const option = sel.options[sel.selectedIndex];

        if(!startAddress || !option.dataset.lat){
            alert("Vul zowel startlocatie als parking in");
            return;
        }

        const geo  = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(startAddress)}`);
        const data = await geo.json();
        if(!data.length){ alert("Startadres niet gevonden"); return; }

        const startLat = parseFloat(data[0].lat);
        const startLng = parseFloat(data[0].lon);
        const endLat   = parseFloat(option.dataset.lat);
        const endLng   = parseFloat(option.dataset.lng);

        if(startMarker) map.removeLayer(startMarker);
        if(endMarker)   map.removeLayer(endMarker);
        if(routeLine)   map.removeLayer(routeLine);

        startMarker = L.marker([startLat, startLng]).addTo(map);
        endMarker   = L.marker([endLat,   endLng  ]).addTo(map);

        const route     = await fetch(
            `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${ORS_API_KEY}&start=${startLng},${startLat}&end=${endLng},${endLat}`
        );
        const routeData = await route.json();

        if(routeData.features){
            const coords   = routeData.features[0].geometry.coordinates;
            const latlngs  = coords.map(c => [c[1], c[0]]);
            routeLine      = L.polyline(latlngs, {color:'#667eea', weight:5}).addTo(map);
            map.fitBounds(routeLine.getBounds());

            // Extract distance (metres) and duration (seconds) from the response
            const summary  = routeData.features[0].properties.summary;
            const distM    = summary.distance;   // metres
            const durS     = summary.duration;   // seconds

            showRoutePopup(distM, durS, option.text.trim());
        }
    }
</script>
</body>
</html>