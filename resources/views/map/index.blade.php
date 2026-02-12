<!DOCTYPE html>
<html>
<head>
    <title>Campus Parking Route</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; }
        .controls {
            margin: 20px 0;
        }
        .controls input {
            padding: 10px;
            margin: 5px;
            width: 300px;
        }
        .controls button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .controls button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Campus Parking - Route Planner</h1>
    
    <div class="controls">
        <input type="text" id="startLocation" placeholder="Your starting location (e.g., address or click map)">
        <input type="text" id="endLocation" placeholder="Parking spot address">
        <button onclick="calculateRoute()">Get Directions</button>
        <button onclick="useCurrentLocation()">Use My Location</button>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize map (centered on your campus - update coordinates!)
        const map = L.map('map').setView([52.1, 5.1], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Your OpenRouteService API key
        const ORS_API_KEY = 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6IjE1OTFjMDFlZDUyYjQzOWNiZGI2MjQxMDYxODQyYmUxIiwiaCI6Im11cm11cjY0In0='; // Replace with your actual key

        let startMarker, endMarker, routeLine;
        let startCoords = null;
        let endCoords = null;

        // Click on map to set start/end points
        map.on('click', function(e) {
            if (!startCoords) {
                startCoords = [e.latlng.lng, e.latlng.lat];
                if (startMarker) map.removeLayer(startMarker);
                startMarker = L.marker([e.latlng.lat, e.latlng.lng])
                    .addTo(map)
                    .bindPopup('Start Location')
                    .openPopup();
            } else if (!endCoords) {
                endCoords = [e.latlng.lng, e.latlng.lat];
                if (endMarker) map.removeLayer(endMarker);
                endMarker = L.marker([e.latlng.lat, e.latlng.lng])
                    .addTo(map)
                    .bindPopup('Parking Spot')
                    .openPopup();
                
                // Automatically calculate route
                getRoute(startCoords, endCoords);
            } else {
                // Reset
                resetRoute();
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
                    startMarker = L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup('Your Location')
                        .openPopup();
                    
                    map.setView([lat, lng], 15);
                    alert('Click on the map to select your parking destination');
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

                    // Draw route
                    routeLine = L.polyline(latLngs, {
                        color: 'blue',
                        weight: 5,
                        opacity: 0.7
                    }).addTo(map);

                    // Fit map to show entire route
                    map.fitBounds(routeLine.getBounds());

                    // Show distance and time
                    alert(`Route found!\nDistance: ${distance} km\nEstimated time: ${duration} minutes`);
                } else {
                    alert('No route found');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error calculating route. Check console for details.');
            }
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
                
                startMarker = L.marker([startGeocode.lat, startGeocode.lng])
                    .addTo(map)
                    .bindPopup('Start: ' + start);
                
                endMarker = L.marker([endGeocode.lat, endGeocode.lng])
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
        }
    </script>
</body>
</html>