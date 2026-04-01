<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Parking Route</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); min-height:100vh; padding:20px; }
        .container { max-width:1200px; margin:0 auto; background:white; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.3); overflow:hidden; }
        .header { background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; padding:24px 30px; text-align:center; }
        .header h1 { font-size:1.5rem; font-weight:700; }
        .header p { font-size:.85rem; opacity:.8; margin-top:4px; }
        .content { padding:24px 30px; }

        .controls { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px; }
        .controls label { display:block; font-size:.78rem; font-weight:600; color:#555; margin-bottom:5px; }
        .controls input, .controls select { width:100%; padding:12px 14px; border:2px solid #e0e0e0; border-radius:10px; font-family:'Inter',sans-serif; font-size:.9em; color:#333; transition:border-color .2s; }
        .controls input:focus, .controls select:focus { outline:none; border-color:#667eea; }
        .controls button { grid-column:1/-1; padding:14px; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600; font-size:1em; font-family:'Inter',sans-serif; transition:opacity .2s, transform .15s; }
        .controls button:hover { opacity:.9; transform:translateY(-1px); }

        .parking-badge { display:inline-block; margin-top:5px; padding:3px 10px; border-radius:20px; font-size:.75em; font-weight:600; }
        .badge-free   { background:#d4edda; color:#155724; }
        .badge-paid   { background:#fff3cd; color:#856404; }
        .badge-permit { background:#cce5ff; color:#004085; }
        .badge-hidden { display:none; }

        #map { height:460px; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); }

        /* Spinner */
        .spinner-wrap { display:none; align-items:center; justify-content:center; gap:8px; padding:8px; color:#888; font-size:.82rem; }
        .spinner-wrap.active { display:flex; }
        .spinner { width:16px; height:16px; border:2px solid #e0e0e0; border-top-color:#667eea; border-radius:50%; animation:spin .7s linear infinite; }
        @keyframes spin { to { transform:rotate(360deg); } }

        /* Weather card */
        #weatherCard { display:none; margin-top:16px; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1); animation:slideUp .35s ease; }
        @keyframes slideUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .weather-inner { background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; padding:20px 24px; }
        .weather-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
        .weather-label { font-size:.7rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase; opacity:.7; }
        .weather-name { font-size:1rem; font-weight:700; margin-top:3px; }
        #weatherEmojiBig { font-size:2.4rem; line-height:1; }
        .weather-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
        .weather-stat { background:rgba(255,255,255,.15); border-radius:10px; padding:14px 10px; text-align:center; }
        .weather-stat-emoji { font-size:1.2rem; margin-bottom:4px; }
        .weather-stat-val { font-size:1.5rem; font-weight:700; line-height:1; }
        .weather-stat-unit { font-size:.72rem; opacity:.7; margin-top:1px; }
        .weather-stat-label { font-size:.62rem; opacity:.55; text-transform:uppercase; letter-spacing:.06em; margin-top:3px; }

        /* Popup */
        .popup-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); backdrop-filter:blur(4px); z-index:9999; align-items:center; justify-content:center; }
        .popup-overlay.active { display:flex; }
        .popup-card { background:white; border-radius:20px; padding:32px 36px; box-shadow:0 30px 80px rgba(0,0,0,0.25); max-width:400px; width:90%; text-align:center; animation:popIn .3s cubic-bezier(.34,1.56,.64,1); }
        @keyframes popIn { from{transform:scale(0.8);opacity:0} to{transform:scale(1);opacity:1} }
        .popup-icon { font-size:2.6rem; margin-bottom:8px; }
        .popup-title { font-size:1.2rem; font-weight:700; color:#333; margin-bottom:4px; }
        .popup-dest { font-size:.82rem; color:#888; margin-bottom:20px; }
        .popup-stats { display:flex; gap:12px; justify-content:center; margin-bottom:14px; }
        .stat-box { flex:1; background:linear-gradient(135deg,#f0f0ff,#f8f0ff); border-radius:12px; padding:16px 12px; }
        .stat-value { font-size:1.9rem; font-weight:700; color:#667eea; line-height:1; }
        .stat-unit { font-size:.9rem; font-weight:500; color:#764ba2; }
        .stat-label { font-size:.7rem; color:#999; margin-top:4px; text-transform:uppercase; letter-spacing:.06em; }
        .popup-arrival { font-size:.78rem; color:#888; background:#f8f8ff; border-radius:8px; padding:8px 14px; margin-bottom:18px; }
        .popup-close { padding:12px 36px; background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:white; border:none; border-radius:10px; font-size:.92em; font-weight:600; cursor:pointer; font-family:'Inter',sans-serif; transition:opacity .2s; }
        .popup-close:hover { opacity:.85; }

        /* Rain alert */
        #rainAlert { display:none; margin-top:12px; background:#fff3cd; border:1.5px solid #ffc107; border-radius:12px; padding:14px 18px; display:none; align-items:center; gap:12px; animation:slideUp .35s ease; }
        #rainAlert.active { display:flex; }
        #rainAlert .rain-icon { font-size:1.8rem; line-height:1; }
        #rainAlert .rain-text { font-size:.88rem; color:#856404; font-weight:500; line-height:1.4; }
        #rainAlert .rain-text strong { display:block; font-size:.95rem; margin-bottom:2px; color:#6d4c00; }

        @media(max-width:768px) { .controls{grid-template-columns:1fr} #map{height:340px} }
    </style>
</head>
<body>

<!-- Popup -->
<div class="popup-overlay" id="routePopup" onclick="if(event.target===this)this.classList.remove('active')">
    <div class="popup-card">
        <div class="popup-icon">🗺️</div>
        <div class="popup-title">Route Found!</div>
        <div class="popup-dest" id="popupDest"></div>
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
        <div class="popup-arrival" id="popupArrival"></div>
        <button class="popup-close" onclick="document.getElementById('routePopup').classList.remove('active')">Got it, show route →</button>
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
                        <option value="{{ $loc->id }}" data-lat="{{ $loc->latitude }}" data-lng="{{ $loc->longitude }}" data-type="{{ $loc->type }}">
                            {{ $loc->location_name }}
                        </option>
                    @endforeach
                </select>
                <span id="parkingBadge" class="parking-badge badge-hidden"></span>
            </div>
            <div>
                <label> Arrival Date &amp; Time</label>
                <input type="datetime-local" id="arrivalTime">
            </div>
            <div style="display:flex;align-items:flex-end;">
                <button style="width:100%;margin:0" onclick="calculateRoute()">🗺️ Get Directions</button>
            </div>
        </div>
        <div class="spinner-wrap" id="spinner"><div class="spinner"></div> Calculating route…</div>

        <div id="map"></div>

        <div id="weatherCard">
            <div class="weather-inner">
                <div class="weather-top">
                    <div>
                        <div class="weather-label">Weather Forecast</div>
                        <div class="weather-name" id="weatherName">At your parking spot</div>
                    </div>
                    <div id="weatherEmojiBig">☀️</div>
                </div>
                <div class="weather-grid" id="weatherContent"></div>
            </div>
        </div>

        <div id="rainAlert">
            <div class="rain-icon">☔</div>
            <div class="rain-text">
                <strong>Rain expected at arrival!</strong>
                There's a <span id="rainChance"></span>% chance of rain — don't forget your umbrella.
            </div>
        </div>
    </div>
</div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            // --- Kaart setup ---
            const map = L.map('map').setView([52.1, 5.1], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

            let startM, endM, routeL;
            const pad = n => String(n).padStart(2, '0');

            // --- Datum op huidige tijd zetten ---
            const now = new Date();
            const local = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}`;
            Object.assign(document.getElementById('arrivalTime'), { min: local, value: local });

            // --- Parkeer icoon per type ---
            function parkingIcon(type) {
                const color = { free: '#28a745', paid: '#e6a817', permit: '#007bff' }[type] || '#667eea';
                return L.divIcon({
                    className: '', iconSize: [34, 34], iconAnchor: [17, 34], popupAnchor: [0, -36],
                    html: `<div style="background:${color};color:white;font-weight:800;font-size:14px;width:34px;height:34px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(0,0,0,0.3);border:2px solid white"><span style="transform:rotate(45deg)">P</span></div>`
                });
            }

            // --- Weer emoji op basis van weercode ---
            function wEmoji(c) {
                if (c === 0)  return '☀️';
                if (c <= 3)   return '⛅';
                if (c <= 49)  return '🌫️';
                if (c <= 67)  return '🌧️';
                if (c <= 77)  return '❄️';
                if (c <= 82)  return '🌦️';
                return '⛈️';
            }

            // --- Parkeermarkers op kaart zetten ---
            const bounds = [];
            document.querySelectorAll('#endLocation option[data-lat]').forEach(opt => {
                const lat = parseFloat(opt.dataset.lat), lng = parseFloat(opt.dataset.lng);
                if (isNaN(lat) || isNaN(lng)) return;

                const labels = { free: '✅ Free', paid: '💰 Paid', permit: '🔒 Permit' };
                L.marker([lat, lng], { icon: parkingIcon(opt.dataset.type) })
                    .addTo(map)
                    .bindPopup(`<strong>${opt.textContent.trim()}</strong><br><span style="font-size:.82em;color:#666">${labels[opt.dataset.type] || ''}</span>`)
                    .on('click', () => {
                        const sel = document.getElementById('endLocation');
                        for (let i = 0; i < sel.options.length; i++) {
                            if (sel.options[i].value === opt.value) { sel.selectedIndex = i; onParkingSelect(); break; }
                        }
                    });
                bounds.push([lat, lng]);
            });
            if (bounds.length) map.fitBounds(bounds, { padding: [40, 40] });

            // --- Badge tonen bij selectie parking ---
            function onParkingSelect() {
                const type  = document.getElementById('endLocation').selectedOptions[0]?.dataset?.type;
                const badge = document.getElementById('parkingBadge');
                const map   = { free: ['badge-free', '✅ Free'], paid: ['badge-paid', '💰 Paid'], permit: ['badge-permit', '🔒 Permit Required'] };
                const match = map[type];
                badge.className = match ? `parking-badge ${match[0]}` : 'parking-badge badge-hidden';
                badge.textContent = match ? match[1] : '';
            }

            // --- Weer weergeven ---
            function renderWeather(w, name) {
                document.getElementById('weatherEmojiBig').textContent = wEmoji(w.weather_code);
                document.getElementById('weatherName').textContent     = name;
                document.getElementById('weatherContent').innerHTML    = `
                    <div class="weather-stat"><div class="weather-stat-emoji">🌡️</div><div class="weather-stat-val">${w.temperature}°</div><div class="weather-stat-unit">Celsius</div><div class="weather-stat-label">Temperature</div></div>
                    <div class="weather-stat"><div class="weather-stat-emoji">🌧️</div><div class="weather-stat-val">${w.rain_chance}%</div><div class="weather-stat-unit">Chance</div><div class="weather-stat-label">Rain probability</div></div>
                    <div class="weather-stat"><div class="weather-stat-emoji">💨</div><div class="weather-stat-val">${w.wind_speed}</div><div class="weather-stat-unit">km/h</div><div class="weather-stat-label">Wind speed</div></div>`;
                document.getElementById('weatherCard').style.display = 'block';

                const rainAlert = document.getElementById('rainAlert');
                if (w.rain_chance >= 50) {
                    document.getElementById('rainChance').textContent = w.rain_chance;
                    rainAlert.classList.add('active');
                } else {
                    rainAlert.classList.remove('active');
                }
            }

            // --- Route berekenen ---
            async function calculateRoute() {
                const addr  = document.getElementById('startLocation').value.trim();
                const locId = document.getElementById('endLocation').value;
                const dtVal = document.getElementById('arrivalTime').value;

                if (!addr || !locId) { alert('Vul zowel startlocatie als parking in'); return; }

                const sp = document.getElementById('spinner');
                sp.classList.add('active');

                try {
                    const res  = await fetch('/maps/route', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ address: addr, location_id: locId, arrival: dtVal }),
                    });

                    const data = await res.json();
                    if (!res.ok) { alert(data.error || 'Er ging iets mis.'); return; }

                    // Oude lagen verwijderen en nieuwe zetten
                    if (startM) map.removeLayer(startM);
                    if (endM)   map.removeLayer(endM);
                    if (routeL) map.removeLayer(routeL);

                    startM = L.marker([data.start.lat, data.start.lng]).addTo(map).bindPopup('<strong>Start</strong>');
                    endM   = L.marker([data.location.lat, data.location.lng], { icon: parkingIcon(data.location.type) }).addTo(map).bindPopup(`<strong>${data.location.name}</strong>`);
                    routeL = L.polyline(data.route.coordinates.map(c => [c[1], c[0]]), { color: '#667eea', weight: 5 }).addTo(map);
                    map.fitBounds(routeL.getBounds(), { padding: [50, 50] });

                    // Popup vullen
                    const tot = data.route.duration_min;
                    const tv  = tot >= 60 ? `${Math.floor(tot/60)}h ${tot%60 ? tot%60 : ''}`.trim() : tot;
                    const tu  = tot >= 60 ? (tot%60 ? 'hr min' : 'hr') : 'min';

                    document.getElementById('popupKm').textContent       = data.route.distance_km;
                    document.getElementById('popupTime').textContent     = tv;
                    document.getElementById('popupTimeUnit').textContent = tu;
                    document.getElementById('popupDest').textContent     = `📍 To: ${data.location.name}`;

                    if (dtVal) {
                        const d = new Date(dtVal);
                        document.getElementById('popupArrival').textContent =
                            `🕐 Arriving: ${d.toLocaleString('en-GB', { weekday:'short', day:'numeric', month:'short', hour:'2-digit', minute:'2-digit' })}`;
                    }

                    document.getElementById('routePopup').classList.add('active');

                    if (data.weather && Object.keys(data.weather).length) renderWeather(data.weather, data.location.name);

                } catch (e) {
                    console.error(e);
                    alert('Er is iets misgegaan. Probeer opnieuw.');
                } finally {
                    sp.classList.remove('active');
                }
            }

            document.getElementById('startLocation').addEventListener('keydown', e => { if (e.key === 'Enter') calculateRoute(); });
        </script>
    </body>
</html>