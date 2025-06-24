@extends('layouts.base')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row" style="height: calc(100vh - 100px);">
            <!-- Carte principale -->
            <div class="col-12 h-100 position-relative">
                <h5>🗺️ Carte des livraisons</h5>
                <div id="map" class="rounded shadow-sm w-100 h-100"></div>

                <!-- Boutons de contrôle en haut à droite -->
                <div class="position-absolute top-0 end-0 mt-5 me-3 d-flex gap-2" style="z-index: 1100;">
                    <button class="btn btn-primary shadow-sm" type="button" data-bs-toggle="collapse"
                        data-bs-target="#deliveriesPanel" aria-expanded="false" aria-controls="deliveriesPanel">
                        📦 Liste des livraisons
                    </button>
                    <button class="btn btn-success shadow-sm" type="button" id="locateVehicleBtn">
                        🚚 Localiser véhicule
                    </button>
                </div>

                <!-- Panneau déroulant -->
                <div class="position-absolute top-0 end-0 mt-5 me-3 collapse" id="deliveriesPanel"
                    style="width: 350px; max-height: 75vh; margin-top: 50px !important; z-index: 1050; background: white; box-shadow: 0 0 15px rgba(0,0,0,0.3); border-radius: 8px;">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <div class="card-body p-0 flex-grow-1" style="overflow-y: auto;">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th>Code</th>
                                        <th>Adresse</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr onclick="showRoute('Livraison A', [
                                        { lat: -4.325, lng: 15.322, label: 'Départ' },
                                        { lat: -4.328, lng: 15.335, label: 'Étape' },
                                        { lat: -4.330, lng: 15.345, label: 'Destination' }
                                    ])"
                                        style="cursor: pointer;">
                                        <td>A001</td>
                                        <td>Vers commune Gombe</td>
                                        <td><span class="badge bg-success">Livré</span></td>
                                    </tr>
                                    <tr onclick="showRoute('Livraison B', [
                                        { lat: -4.34, lng: 15.31, label: 'Départ' },
                                        { lat: -4.345, lng: 15.32, label: 'Étape' },
                                        { lat: -4.35, lng: 15.33, label: 'Destination' }
                                    ])"
                                        style="cursor: pointer;">
                                        <td>B002</td>
                                        <td>Vers Kalamu</td>
                                        <td><span class="badge bg-warning text-dark">En cours</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Contrôles de zoom -->
                <div class="position-absolute bottom-0 end-0 mb-3 me-3" style="z-index: 1100;">
                    <div class="btn-group-vertical shadow-sm">
                        <button class="btn btn-light" onclick="map.zoomIn()">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <button class="btn btn-light" onclick="map.zoomOut()">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet + style clair OpenStreetMap -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <script>
        let map;
        let currentPolyline;
        let currentMarkers = [];
        let vehicleMarker;

        const icons = {
            "Départ": new L.Icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            }),
            "Étape": new L.Icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3448/3448440.png',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            }),
            "Destination": new L.Icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/535/535137.png',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            }),
            "Vehicle": new L.Icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/854/854894.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            }),
        };

        document.addEventListener("DOMContentLoaded", function() {
            map = L.map('map').setView([-4.325, 15.322], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            document.getElementById('locateVehicleBtn').addEventListener('click', function() {
                locateVehicle();
            });
        });

        function showRoute(code, coords) {
            if (currentPolyline) map.removeLayer(currentPolyline);
            currentMarkers.forEach(marker => map.removeLayer(marker));
            currentMarkers = [];

            coords.forEach(point => {
                const marker = L.marker([point.lat, point.lng], {
                        icon: icons[point.label] || undefined
                    }).addTo(map)
                    .bindPopup(`<b>${point.label}</b> de ${code}`)
                    .openPopup();

                currentMarkers.push(marker);
            });

            const latlngs = coords.map(p => [p.lat, p.lng]);
            currentPolyline = L.polyline(latlngs, {
                color: 'orange',
                weight: 5,
                opacity: 0.8
            }).addTo(map);

            map.fitBounds(currentPolyline.getBounds(), {
                padding: [20, 20]
            });

            // Fermer le panneau après sélection (optionnel)
            const panel = new bootstrap.Collapse(document.getElementById('deliveriesPanel'));
            panel.hide();
        }

        function locateVehicle() {
            // Exemple : coordonnées simulées du véhicule
            const vehiclePos = [-4.33, 15.34];

            // Supprimer l'ancien marqueur véhicule s’il existe
            if (vehicleMarker) {
                map.removeLayer(vehicleMarker);
            }

            vehicleMarker = L.marker(vehiclePos, {
                    icon: icons.Vehicle
                }).addTo(map)
                .bindPopup('<b>Véhicule</b><br>Position actuelle')
                .openPopup();

            // Centrer la carte sur le véhicule
            map.setView(vehiclePos, 15);
        }
    </script>
@endsection
