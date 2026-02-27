<!DOCTYPE html>
<html>
<head>
    <title>Campus Parking Route</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 0.85em;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .controls input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .controls input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .button-group {
            grid-column: 1 / -1;
            display: flex;
            gap: 15px;
        }

        .controls button {
            flex: 1;
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .controls button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .controls button:active {
            transform: translateY(0);
        }

        .controls button.secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
        }

        .controls button.secondary:hover {
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.6);
        }

        .controls button.reset {
            background: #6c757d;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
        }

        .controls button.reset:hover {
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.6);
        }

        #routeInfo {
            display: none;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #routeInfo.show {
            display: block;
        }

        .route-info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .route-info-header h3 {
            color: #333;
            font-size: 1.3em;
            font-weight: 700;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: white;
            transform: rotate(90deg);
        }

        .route-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .route-detail-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .route-detail-card .icon {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .route-detail-card .label {
            font-size: 0.85em;
            color: #666;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .route-detail-card .value {
            font-size: 1.8em;
            font-weight: 700;
            color: #333;
        }

        #map {
            height: 500px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .instructions {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .instructions h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .instructions ul {
            list-style: none;
            padding-left: 0;
        }

        .instructions li {
            padding: 8px 0;
            color: #666;
            position: relative;
            padding-left: 25px;
        }

        .instructions li:before {
            content: "→";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .controls {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .header h1 {
                font-size: 1.8em;
            }

            .route-details {
                grid-template-columns: 1fr;
            }
        }
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
                <div class="input-group">
                    <label for="startLocation">📍 Starting Location</label>
                    <input type="text" id="startLocation" placeholder="Enter address or click on map">
                </div>
                <div class="input-group">
                    <label for="endLocation">🅿️ Parking Destination</label>
                    <input type="text" id="endLocation" placeholder="Enter parking spot address">
                </div>
                <div class="button-group">
                    <button onclick="calculateRoute()">🗺️ Get Directions</button>
                    <button class="secondary" onclick="useCurrentLocation()">📱 Use My Location</button>
                    <button class="reset" onclick="resetRoute()">🔄 Reset</button>
                </div>
            </div>

            <div id="routeInfo">
                <div class="route-info-header">
                    <h3>📊 Route Information</h3>
                    <button class="close-btn" onclick="hideRouteInfo()">×</button>
                </div>
                <div class="route-details">
                    <div class="route-detail-card">
                        <div class="icon">📏</div>
                        <div class="label">Distance</div>
                        <div class="value" id="distanceValue">-</div>
                    </div>
                    <div class="route-detail-card">
                        <div class="icon">⏱️</div>
                        <div class="label">Est. Time</div>
                        <div class="value" id="timeValue">-</div>
                    </div>
                    <div class="route-detail-card">
                        <div class="icon">🚗</div>
                        <div class="label">Status</div>
                        <div class="value" style="font-size: 1.2em; color: #28a745;">Active</div>
                    </div>
                </div>
            </div>

            <div id="map"></div>

            <div class="instructions">
                <h3>💡 How to Use</h3>
                <ul>
                    <li>Enter addresses in the fields above or click directly on the map</li>
                    <li>First click sets your starting point, second click sets destination</li>
                    <li>Use "My Location" button to automatically set your current position</li>
                    <li>Route information will appear above the map once calculated</li>
                    <li>Click "Reset" to start over with new locations</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize map (centered on your campus - update coordinates!)
        const map = L.map('map').setView([52.1, 5.1], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Your OpenRouteService API key
        const ORS_API_KEY = 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6IjE1OTFjMDFlZDUyYjQzOWNiZGI2MjQxMDYxODQyYmUxIiwiaCI6Im11cm11cjY0In0=';

        let startMarker, endMarker, routeLine;
        let startCoords = null;
        let endCoords = null;

        // Custom marker icons
        const startIcon = L.divIcon({
            className: 'custom-marker',
            html: '<div style="background: #667eea; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">📍</div>',
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        const endIcon = L.divIcon({
            className: 'custom-marker',
            html: '<div style="background: #f5576c; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">🅿️</div>',
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        // Click on map to set start/end points
        map.on('click', function(e) {
            if (!startCoords) {
                startCoords = [e.latlng.lng, e.latlng.lat];
                if (startMarker) map.removeLayer(startMarker);
                startMarker = L.marker([e.latlng.lat, e.latlng.lng], {icon: startIcon})
                    .addTo(map)
                    .bindPopup('Start Location')
                    .openPopup();
            } else if (!endCoords) {
                endCoords = [e.latlng.lng, e.latlng.lat];
                if (endMarker) map.removeLayer(endMarker);
                endMarker = L.marker([e.latlng.lat, e.latlng.lng], {icon: endIcon})
                    .addTo(map)
                    .bindPopup('Parking Spot')
                    .openPopup();
                
                // Automatically calculate route
                getRoute(startCoords, endCoords);
            } else {
                // Reset
                alert('Route already set! Click "Reset" to start over.');
            }
        });

        // Use current location
        function useCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    startCoords = [lng, lat];
                    if (startMarker) map.removeLayer(startMarker);
                    startMarker = L.marker([lat, lng], {icon: startIcon})
                        .addTo(map)
                        .bindPopup('Your Location')
                        .openPopup();
                    
                    map.setView([lat, lng], 15);
                    alert('Now click on the map to select your parking destination, or enter an address.');
                }, function(error) {
                    alert('Error getting location: ' + error.message);
                });
            } else {
                alert('Geolocation not supported by your browser');
            }
        }

        // Get route from OpenRouteService
        async function getRoute(start, end) {
            const url = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${ORS_API_KEY}&start=${start[0]},${start[1]}&end=${end[0]},${end[1]}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.features && data.features.length > 0) {
                    const coords = data.features[0].geometry.coordinates;
                    const distance = (data.features[0].properties.segments[0].distance / 1000).toFixed(2);
                    const duration = Math.round(data.features[0].properties.segments[0].duration / 60);

                    // Convert coordinates for Leaflet (swap lng,lat to lat,lng)
                    const latLngs = coords.map(coord => [coord[1], coord[0]]);

                    // Remove old route if exists
                    if (routeLine) map.removeLayer(routeLine);

                    // Draw route with gradient effect
                    routeLine = L.polyline(latLngs, {
                        color: '#667eea',
                        weight: 6,
                        opacity: 0.8
                    }).addTo(map);

                    // Fit map to show entire route
                    map.fitBounds(routeLine.getBounds(), {padding: [50, 50]});

                    // Update and show route info panel
                    showRouteInfo(distance, duration);
                } else {
                    alert('No route found');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error calculating route. Check console for details.');
            }
        }

        // Show route information
        function showRouteInfo(distance, duration) {
            document.getElementById('distanceValue').textContent = distance + ' km';
            document.getElementById('timeValue').textContent = duration + ' min';
            document.getElementById('routeInfo').classList.add('show');
        }

        // Hide route information
        function hideRouteInfo() {
            document.getElementById('routeInfo').classList.remove('show');
        }

        // Calculate route from addresses (using geocoding)
        async function calculateRoute() {
            const start = document.getElementById('startLocation').value;
            const end = document.getElementById('endLocation').value;

            if (!start || !end) {
                alert('Please enter both start and end locations');
                return;
            }

            // Geocode addresses to coordinates
            const startGeocode = await geocodeAddress(start);
            const endGeocode = await geocodeAddress(end);

            if (startGeocode && endGeocode) {
                startCoords = [startGeocode.lng, startGeocode.lat];
                endCoords = [endGeocode.lng, endGeocode.lat];

                // Add markers
                if (startMarker) map.removeLayer(startMarker);
                if (endMarker) map.removeLayer(endMarker);
                
                startMarker = L.marker([startGeocode.lat, startGeocode.lng], {icon: startIcon})
                    .addTo(map)
                    .bindPopup('Start: ' + start);
                
                endMarker = L.marker([endGeocode.lat, endGeocode.lng], {icon: endIcon})
                    .addTo(map)
                    .bindPopup('Destination: ' + end);

                // Get route
                await getRoute(startCoords, endCoords);
            }
        }

        // Geocode address using Nominatim (free OpenStreetMap geocoding)
        async function geocodeAddress(address) {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;
            
            try {
                const response = await fetch(url);
                const data = await response.json();
                
                if (data && data.length > 0) {
                    return {
                        lat: parseFloat(data[0].lat),
                        lng: parseFloat(data[0].lon)
                    };
                } else {
                    alert('Address not found: ' + address);
                    return null;
                }
            } catch (error) {
                console.error('Geocoding error:', error);
                alert('Error finding address');
                return null;
            }
        }

        // Reset route
        function resetRoute() {
            if (startMarker) map.removeLayer(startMarker);
            if (endMarker) map.removeLayer(endMarker);
            if (routeLine) map.removeLayer(routeLine);
            startCoords = null;
            endCoords = null;
            document.getElementById('startLocation').value = '';
            document.getElementById('endLocation').value = '';
            hideRouteInfo();
            map.setView([52.1, 5.1], 13);
        }
    </script>
</body>
</html>