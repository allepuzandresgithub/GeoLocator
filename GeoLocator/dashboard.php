<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel de Control</title>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
:root {
    --bg-color: #121212;
    --glass-color: rgba(30, 30, 30, 0.6);
    --text-color: #e0e0e0;
    --accent-color: #4CAF50;
    --button-color: #2196F3;
    --button-hover: #1976D2;
}

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-color);
    background-image: radial-gradient(circle at top left, #1e1e1e, #121212);
}

.header {
    background-color: var(--accent-color);
    padding: 1rem 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    margin: 0;
    font-size: 1.5rem;
}

.header a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.container {
    padding: 2rem;
    max-width: 900px;
    margin: auto;
}

.card {
    background-color: var(--glass-color);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.6);
    margin-bottom: 2rem;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: scale(1.02);
}

button {
    padding: 0.8rem 1.2rem;
    background-color: var(--button-color);
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: var(--button-hover);
    transform: scale(1.05);
}

#map {
    width: 100%;
    height: 500px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    margin-top: 1rem;
}

/* Panel lateral */
.map-panel {
    position: fixed;
    top: 80px;
    left: 20px;
    width: 250px;
    background-color: rgba(30, 30, 30, 0.7);
    backdrop-filter: blur(8px);
    padding: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    color: #e0e0e0;
    z-index: 1000;
    transition: transform 0.3s ease;
}

.map-panel h3 {
    margin-top: 0;
}

.map-panel input, .map-panel select {
    width: 100%;
    margin-bottom: 1rem;
    padding: 0.5rem;
    border-radius: 6px;
    border: none;
    background-color: #2c2c2c;
    color: white;
}

.map-panel button {
    width: 100%;
    padding: 0.6rem;
    background-color: #2196F3;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
}

.toggle-panel {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
    cursor: pointer;
    z-index: 1100;
}
</style>
</head>
<body>
<div class="header">
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
    <a href="logout.php">Cerrar sesión</a>
</div>
<div class="container">
    <div class="card">
        <h2>Panel principal</h2>
        <p>Pulsa el botón para obtener tu ubicación y explorar el mapa.</p>
        <button onclick="loadMap()">Obtener ubicación</button>
        <div id="map"></div>
    </div>
</div>

<!-- Panel lateral -->
<div class="map-panel" id="mapPanel">
    <h3>Explorar mapa</h3>
    <label>Buscar ciudad o coordenadas:</label>
    <input type="text" id="searchInput" placeholder="Ej: Madrid o 40.4,-3.7">
    <button onclick="searchLocation()">Buscar</button>

    <label>Tipo de mapa:</label>
    <select id="layerSelect" onchange="changeLayer()">
        <option value="sat">Satélite</option>
        <option value="road">Carreteras</option>
    </select>
</div>
<button class="toggle-panel" onclick="togglePanel()">☰</button>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let map;
let satLayer, roadLayer;

function togglePanel() {
    const panel = document.getElementById('mapPanel');
    panel.style.transform = panel.style.transform === 'translateX(-270px)' ? 'translateX(0)' : 'translateX(-270px)';
}

function loadMap() {
    fetch('http://ip-api.com/json/')
        .then(res => res.json())
        .then(data => {
            const lat = data.lat || 0;
            const lon = data.lon || 0;
            const city = data.city || 'Desconocida';
            const country = data.country || 'Desconocido';

            if (map) {
                map.remove();
            }

            map = L.map('map').setView([lat, lon], 13);

            satLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Satélite © Esri',
                maxZoom: 18
            });

            roadLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Carreteras © OpenStreetMap',
                maxZoom: 19
            });

            satLayer.addTo(map);

            L.control.layers({
                "Satélite": satLayer,
                "Carreteras": roadLayer
            }).addTo(map);

            L.marker([lat, lon])
                .addTo(map)
                .bindPopup(`<b>${city}, ${country}</b><br>Lat: ${lat}<br>Lon: ${lon}`)
                .openPopup();
        })
        .catch(err => {
            alert("No se pudo obtener la ubicación.");
            console.error(err);
        });
}

function changeLayer() {
    const selected = document.getElementById('layerSelect').value;
    if (!map || !satLayer || !roadLayer) return;

    if (selected === 'sat') {
        map.removeLayer(roadLayer);
        satLayer.addTo(map);
    } else {
        map.removeLayer(satLayer);
        roadLayer.addTo(map);
    }
}

function searchLocation() {
    const input = document.getElementById('searchInput').value.trim();
    if (!input) return;

    let query = input.includes(',') ? input : encodeURIComponent(input);

    fetch(`https://nominatim.openstreetmap.org/search?q=${query}&format=json`)
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                alert("Ubicación no encontrada.");
                return;
            }
            const lat = parseFloat(data[0].lat);
            const lon = parseFloat(data[0].lon);
            map.setView([lat, lon], 13);
            L.marker([lat, lon]).addTo(map).bindPopup(`Ubicación buscada`).openPopup();
        })
        .catch(err => {
            console.error(err);
            alert("Error al buscar ubicación.");
        });
}
</script>
</body>
</html>

