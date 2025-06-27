@extends('layouts.base')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row" style="height: calc(100vh - 100px);">
            <!-- Carte principale -->
            <div class="col-12 h-100 position-relative">
                <h5>🗺️ Carte des livraisons</h5>
                <div id="map" class="rounded shadow-sm w-100 h-100"></div>

                <!-- Boutons de contrôle en haut à droite -->
                <div class="position-absolute top-0 end-0 mt-5 me-5 d-flex gap-2" style="z-index: 1100;">
                    <button class="btn btn-primary shadow-sm" type="button" data-bs-toggle="collapse"
                        data-bs-target="#deliveriesPanel" aria-expanded="false" aria-controls="deliveriesPanel">
                        📦 Liste des livraisons
                    </button>
                    <button class="btn btn-success shadow-sm" type="button" id="locateVehicleBtn">
                        🚚 Localiser véhicule
                    </button>
                    <button class="btn btn-danger shadow-sm" type="button" id="stopTrackingBtn" style="display: none;">
                        ✋ Arrêter le suivi
                    </button>
                </div>

                <!-- Panneau déroulant -->
                <div class="position-absolute top-0 end-0 mt-5 me-3 collapse" id="deliveriesPanel"
                    style="width: 350px; max-height: 75vh; margin-top: 50px !important; z-index: 1050; background: white; box-shadow: 0 0 15px rgba(0,0,0,0.3); border-radius: 8px;">
                    <div class="card shadow-sm h-100 d-flex flex-column">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Livraisons en cours</h6>
                        </div>
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
                                    @forelse ($livraisons as $livraison)
                                        <tr onclick="showRoute('{{ $livraison->code }}', [

                                                { lat: {{ $livraison->localisations->first()?->latitude }}, lng: {{ $livraison->localisations->first()?->longitude }}, label: '{{ $livraison->vehicule()->immatriculation }}' }{{ !$loop->last ? ',' : '' }}
                                                 { lat: {{ $livraison->expediteur->first()?->latitude }}, lng: {{ $livraison->expediteur->first()?->longitude }}, label: '{{ $livraison->vehicule()->immatriculation }}' }{{ !$loop->last ? ',' : '' }}
                                                  { lat: {{ $livraison->destinateur->first()?->latitude }}, lng: {{ $livraison->destinateur->first()?->longitude }}, label: '{{ $livraison->vehicule()->immatriculation }}' }{{ !$loop->last ? ',' : '' }}
                                        ])"
                                            style="cursor: pointer;">
                                            <td>{{ $livraison->code }}</td>
                                            <td>{{ $livraison->moyen_transport }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $livraison->status }}</span>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse
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
                                    <tr onclick="showRoute('Livraison C', [
                                        { lat: -4.32, lng: 15.30, label: 'Départ' },
                                        { lat: -4.325, lng: 15.31, label: 'Étape' },
                                        { lat: -5.24, lng: 17.32, label: 'Destination' }
                                    ])"
                                        style="cursor: pointer;">
                                        <td>C003</td>
                                        <td>Vers Bandalungwa</td>
                                        <td><span class="badge bg-secondary">En attente</span></td>
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

    <style>
        .vehicle-icon {
            transition: transform 0.5s;
        }

        #map {
            background-color: #f8f9fa;
        }

        .leaflet-popup-content {
            margin: 8px 12px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 8px;
        }

        .route-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        let map;
        let currentPolyline;
        let currentMarkers = [];
        let vehicleMarker;
        let vehicleInterval;
        let currentRoute = [];
        let currentStep = 0;
        let currentDeliveryName = '';

        const icons = {
            "Départ": L.divIcon({
                html: '<div style="background-color: #4CAF50; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">D</div>',
                className: 'd-flex',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            }),
            "Étape": L.divIcon({
                html: '<div style="background-color: #FFC107; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; color: black; font-weight: bold;">E</div>',
                className: 'd-flex',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            }),
            "Destination": L.divIcon({
                html: '<div style="background-color: #F44336; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">A</div>',
                className: 'd-flex',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            }),
            "Vehicle": L.divIcon({
                html: '<div style="transform: rotate(0deg); transition: transform 0.5s;"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#4285F4" viewBox="0 0 16 16"><path d="M0 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a1 1 0 0 1-1 1h-1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1H1a1 1 0 0 1-1-1V6zm2-1a1 1 0 0 0-1 1v5h14V6a1 1 0 0 0-1-1H2z"/><path d="M3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg></div>',
                className: 'vehicle-icon',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            })
        };

        document.addEventListener("DOMContentLoaded", function() {
            // Initialiser la carte
            map = L.map('map').setView([-4.325, 15.322], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Écouteurs d'événements
            document.getElementById('locateVehicleBtn').addEventListener('click', function() {
                locateVehicle();
            });

            document.getElementById('stopTrackingBtn').addEventListener('click', function() {
                stopTracking();
            });
        });

        async function showRoute(deliveryName, coords) {
            currentDeliveryName = deliveryName;

            // Supprimer les éléments existants
            if (currentPolyline) map.removeLayer(currentPolyline);
            currentMarkers.forEach(marker => map.removeLayer(marker));
            currentMarkers = [];

            // Arrêter tout suivi en cours
            if (vehicleInterval) clearInterval(vehicleInterval);
            document.getElementById('stopTrackingBtn').style.display = 'none';
            document.getElementById('locateVehicleBtn').style.display = 'inline-block';

            // Ajouter les marqueurs
            coords.forEach(point => {
                const marker = L.marker([point.lat, point.lng], {
                        icon: icons[point.label] || undefined
                    }).addTo(map)
                    .bindPopup(`<b>${point.label}</b><br>${deliveryName}`)
                    .openPopup();

                currentMarkers.push(marker);
            });

            // Si plus d'un point, calculer l'itinéraire
            if (coords.length > 1) {
                try {
                    // Construire l'URL pour OSRM
                    const coordinates = coords.map(p => `${p.lng},${p.lat}`).join(';');
                    const url =
                        `https://router.project-osrm.org/route/v1/driving/${coordinates}?overview=full&geometries=geojson`;

                    const response = await fetch(url);
                    const data = await response.json();

                    if (data.routes && data.routes.length > 0) {
                        const route = data.routes[0];
                        const routeCoordinates = route.geometry.coordinates.map(c => [c[1], c[0]]);

                        // Supprimer l'ancienne polyligne si elle existe
                        if (currentPolyline) map.removeLayer(currentPolyline);

                        // Créer la nouvelle polyligne avec l'itinéraire
                        currentPolyline = L.polyline(routeCoordinates, {
                            color: '#3388ff',
                            weight: 5,
                            opacity: 0.7,
                            dashArray: '7, 10',
                            lineJoin: 'round'
                        }).addTo(map);

                        // Afficher les infos de la route
                        showRouteInfo(deliveryName, route.distance, route.duration);

                        // Stocker la route pour le suivi
                        currentRoute = routeCoordinates;

                        // Ajuster la vue pour voir tout l'itinéraire
                        map.fitBounds(currentPolyline.getBounds(), {
                            padding: [50, 50]
                        });
                    }
                } catch (error) {
                    console.error("Erreur de calcul d'itinéraire:", error);
                    // Fallback: utiliser une ligne droite si OSRM échoue
                    const latlngs = coords.map(p => [p.lat, p.lng]);
                    currentPolyline = L.polyline(latlngs, {
                        color: 'orange',
                        weight: 3,
                        opacity: 0.5
                    }).addTo(map);

                    currentRoute = latlngs;
                }
            }

            // Fermer le panneau après sélection
            const panel = new bootstrap.Collapse(document.getElementById('deliveriesPanel'));
            panel.hide();
        }

        function showRouteInfo(name, distance, duration) {
            // Supprimer l'ancienne info si elle existe
            const oldInfo = document.querySelector('.route-info');
            if (oldInfo) oldInfo.remove();

            // Convertir les unités
            const distanceKm = (distance / 1000).toFixed(1);
            const durationMin = Math.round(duration / 60);

            // Créer le div d'information
            const infoDiv = document.createElement('div');
            infoDiv.className = 'route-info';
            infoDiv.innerHTML = `
                <h6>${name}</h6>
                <div>Distance: ${distanceKm} km</div>
                <div>Durée estimée: ${durationMin} min</div>
            `;

            document.getElementById('map').appendChild(infoDiv);
        }

        function locateVehicle() {
            if (!currentPolyline || currentRoute.length === 0) {
                alert("Veuillez d'abord sélectionner un itinéraire");
                return;
            }

            // Arrêter tout suivi existant
            if (vehicleInterval) clearInterval(vehicleInterval);

            // Réinitialiser l'étape
            currentStep = 0;

            // Supprimer l'ancien marqueur si existe
            if (vehicleMarker) map.removeLayer(vehicleMarker);

            // Position initiale
            vehicleMarker = L.marker(currentRoute[0], {
                    icon: icons.Vehicle,
                    rotationAngle: getBearing(currentRoute[0], currentRoute[1])
                }).addTo(map)
                .bindPopup('<b>Véhicule de livraison</b><br>En route vers la destination')
                .openPopup();

            // Afficher le bouton d'arrêt
            document.getElementById('stopTrackingBtn').style.display = 'inline-block';
            document.getElementById('locateVehicleBtn').style.display = 'none';

            // Commencer l'animation
            vehicleInterval = setInterval(moveVehicle, 500);
        }

        function moveVehicle() {
            currentStep++;
            if (currentStep >= currentRoute.length) {
                clearInterval(vehicleInterval);
                vehicleMarker.setPopupContent('<b>Véhicule de livraison</b><br>Destination atteinte');
                vehicleMarker.openPopup();
                document.getElementById('stopTrackingBtn').style.display = 'none';
                document.getElementById('locateVehicleBtn').style.display = 'inline-block';
                return;
            }

            // Mettre à jour la position et la rotation
            const nextPos = currentRoute[currentStep];
            const prevPos = currentRoute[currentStep - 1];

            vehicleMarker.setLatLng(nextPos);
            vehicleMarker.setRotationAngle(getBearing(prevPos, nextPos));

            // Centrer la carte sur le véhicule (optionnel)
            map.panTo(nextPos);
        }

        function stopTracking() {
            if (vehicleInterval) {
                clearInterval(vehicleInterval);
                document.getElementById('stopTrackingBtn').style.display = 'none';
                document.getElementById('locateVehicleBtn').style.display = 'inline-block';

                if (vehicleMarker) {
                    vehicleMarker.setPopupContent('<b>Véhicule de livraison</b><br>Suivi arrêté');
                    vehicleMarker.openPopup();
                }
            }
        }

        // Calculer l'angle de rotation pour l'icône du véhicule
        function getBearing(start, end) {
            const startLat = L.LatLng.prototype.isPrototypeOf(start) ? start.lat : start[0];
            const startLng = L.LatLng.prototype.isPrototypeOf(start) ? start.lng : start[1];
            const endLat = L.LatLng.prototype.isPrototypeOf(end) ? end.lat : end[0];
            const endLng = L.LatLng.prototype.isPrototypeOf(end) ? end.lng : end[1];

            const y = Math.sin(endLng - startLng) * Math.cos(endLat);
            const x = Math.cos(startLat) * Math.sin(endLat) -
                Math.sin(startLat) * Math.cos(endLat) * Math.cos(endLng - startLng);
            let bearing = Math.atan2(y, x) * (180 / Math.PI);
            return (bearing + 360) % 360;
        }
    </script>
    {{-- <script>
        let map;
        let currentPolyline;
        let currentMarkers = [];
        let vehicleMarker;
        let vehicleInterval;
        let currentRoute = [];
        let currentStep = 0;
        let currentDeliveryName = '';

        // Liste de toutes les livraisons
        const deliveries = [{
                code: "A001",
                address: "Vers commune Gombe",
                status: "Livré",
                name: "Livraison A",
                coords: [{
                        lat: -4.325,
                        lng: 15.322,
                        label: 'Départ'
                    },
                    {
                        lat: -4.328,
                        lng: 15.335,
                        label: 'Étape'
                    },
                    {
                        lat: -4.330,
                        lng: 15.345,
                        label: 'Destination'
                    }
                ]
            },
            {
                code: "B002",
                address: "Vers Kalamu",
                status: "En cours",
                name: "Livraison B",
                coords: [{
                        lat: -4.34,
                        lng: 15.31,
                        label: 'Départ'
                    },
                    {
                        lat: -4.345,
                        lng: 15.32,
                        label: 'Étape'
                    },
                    {
                        lat: -4.35,
                        lng: 15.33,
                        label: 'Destination'
                    }
                ]
            },
            {
                code: "C003",
                address: "Vers Bandalungwa",
                status: "En attente",
                name: "Livraison C",
                coords: [{
                        lat: -4.32,
                        lng: 15.30,
                        label: 'Départ'
                    },
                    {
                        lat: -4.325,
                        lng: 15.31,
                        label: 'Étape'
                    },
                    {
                        lat: -4.33,
                        lng: 15.32,
                        label: 'Destination'
                    }
                ]
            }
        ];

        // ... (les icônes et autres constantes restent identiques) ...

        document.addEventListener("DOMContentLoaded", function() {
            // Initialiser la carte
            map = L.map('map').setView([-4.325, 15.322], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Afficher toutes les livraisons au chargement
            displayAllDeliveries();

            // ... (le reste des écouteurs d'événements) ...
        });

        // Nouvelle fonction pour afficher toutes les livraisons
        async function displayAllDeliveries() {
            // Supprimer les éléments existants
            if (currentPolyline) map.removeLayer(currentPolyline);
            currentMarkers.forEach(marker => map.removeLayer(marker));
            currentMarkers = [];

            // Parcourir toutes les livraisons
            for (const delivery of deliveries) {
                await showRoute(delivery.name, delivery.coords, false);
            }

            // Ajuster la vue pour voir toutes les livraisons
            const bounds = L.latLngBounds(currentMarkers.map(m => m.getLatLng()));
            map.fitBounds(bounds, {
                padding: [50, 50]
            });
        }

        // Fonction showRoute modifiée
        async function showRoute(deliveryName, coords, fitBounds = true) {
            currentDeliveryName = deliveryName;

            // Ajouter les marqueurs
            coords.forEach(point => {
                const marker = L.marker([point.lat, point.lng], {
                        icon: icons[point.label] || undefined
                    }).addTo(map)
                    .bindPopup(`<b>${point.label}</b><br>${deliveryName}`);

                currentMarkers.push(marker);
            });

            // Si plus d'un point, calculer l'itinéraire
            if (coords.length > 1) {
                try {
                    const coordinates = coords.map(p => `${p.lng},${p.lat}`).join(';');
                    const url =
                        `https://router.project-osrm.org/route/v1/driving/${coordinates}?overview=full&geometries=geojson`;

                    const response = await fetch(url);
                    const data = await response.json();

                    if (data.routes && data.routes.length > 0) {
                        const route = data.routes[0];
                        const routeCoordinates = route.geometry.coordinates.map(c => [c[1], c[0]]);

                        // Créer la polyligne avec l'itinéraire
                        const polyline = L.polyline(routeCoordinates, {
                            color: getColorForStatus(deliveries.find(d => d.name === deliveryName).status),
                            weight: 4,
                            opacity: 0.7,
                            lineJoin: 'round'
                        }).addTo(map);

                        // Stocker la route pour le suivi
                        if (fitBounds) {
                            currentRoute = routeCoordinates;
                            currentPolyline = polyline;
                            map.fitBounds(polyline.getBounds(), {
                                padding: [50, 50]
                            });
                        }
                    }
                } catch (error) {
                    console.error("Erreur de calcul d'itinéraire:", error);
                    // Fallback: ligne droite
                    const latlngs = coords.map(p => [p.lat, p.lng]);
                    const polyline = L.polyline(latlngs, {
                        color: getColorForStatus(deliveries.find(d => d.name === deliveryName).status),
                        weight: 3,
                        opacity: 0.5
                    }).addTo(map);

                    if (fitBounds) {
                        currentRoute = latlngs;
                        currentPolyline = polyline;
                    }
                }
            }
        }

        // Fonction pour obtenir une couleur selon le statut
        function getColorForStatus(status) {
            switch (status) {
                case 'Livré':
                    return '#4CAF50';
                case 'En cours':
                    return '#FFC107';
                case 'En attente':
                    return '#9E9E9E';
                default:
                    return '#4285F4';
            }
        }

        // ... (le reste des fonctions reste identique) ...
    </script> --}}
@endsection
