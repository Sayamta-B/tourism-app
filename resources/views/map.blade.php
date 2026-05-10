<!DOCTYPE html>
<html>
<head>
    <title>Places Map</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #container {
            display: flex;
            height: 100vh;
            position: relative;
        }

        /* MAP */
        #map {
            flex: 1;
        }

        /* SIDEBAR (SLIDE PANEL) */
        #sidebar {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 360px;
            background: #fff;
            border-left: 1px solid #ddd;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);

            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;

            overflow-y: auto;
            z-index: 1000;
        }

        #sidebar.open {
            transform: translateX(0);
        }

        #sidebar-content {
            padding: 16px;
        }

        .place-img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .place-title {
            margin: 0 0 8px;
        }

        .muted {
            color: #666;
            font-size: 14px;
        }

        .info-row {
            margin: 4px 0;
            font-size: 14px;
        }

        /* CLOSE BUTTON */
        #close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #f1f1f1;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            border-radius: 6px;
        }

        #close-btn:hover {
            background: #ddd;
        }

        h2 {
            margin: 0 0 10px;
        }
    </style>
</head>

<body>

<h2 style="padding:10px;">Places Map (Kathmandu Valley)</h2>

<form method="GET" action="{{ url('/map') }}" style="padding:10px; background:#fff;">

    <select name="city">
        <option value="">All Cities</option>

        @foreach($cities as $city)
            <option value="{{ $city->id }}"
                {{ request('city') == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>

    <select name="category">
        <option value="">All Categories</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter Map</button>

</form>

<div id="container">
    <div id="map"></div>

    <!-- SIDEBAR -->
    <div id="sidebar">
        <button id="close-btn">✕</button>

        <div id="sidebar-content">
            <h2>Select a place</h2>
            <p class="muted">Click a marker to view details</p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([27.7172, 85.3240], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    const sidebar = document.getElementById('sidebar');

    // OPEN SIDEBAR
    function openSidebar() {
        sidebar.classList.add('open');
    }

    // CLOSE SIDEBAR
    function closeSidebar() {
        sidebar.classList.remove('open');
    }

    document.getElementById('close-btn').addEventListener('click', closeSidebar);

    // RENDER PLACE
    function showPlace(place) {
        document.getElementById('sidebar-content').innerHTML = `
            ${place.image_url ? `
                <img class="place-img"
                    src="/storage/${place.image_url}"
                    onerror="this.src='places/swayambhu.jpg'"
                />
            ` : ''}

            <h2 class="place-title">${place.name}</h2>

            <p class="muted">${place.description ?? ''}</p>

            <hr>

            <div class="info-row"><b>City:</b> ${place.city?.name ?? 'N/A'}</div>
            <div class="info-row"><b>Category:</b> ${place.category?.name ?? 'N/A'}</div>
            <div class="info-row"><b>Latitude:</b> ${place.latitude}</div>
            <div class="info-row"><b>Longitude:</b> ${place.longitude}</div>
        `;
    }

    // LOAD DATA
        const places = @json($places);

        places.forEach(place => {

            if (!place.latitude || !place.longitude) return;

            const marker = L.marker([
                place.latitude,
                place.longitude
            ]).addTo(map);

            marker.on('click', () => {

                showPlace(place);

                openSidebar();

                map.setView([
                    place.latitude,
                    place.longitude
                ], 15);

            });

        });


    // OPTIONAL: click map closes sidebar (Google Maps feel)
    map.on('click', closeSidebar);

</script>

</body>
</html>