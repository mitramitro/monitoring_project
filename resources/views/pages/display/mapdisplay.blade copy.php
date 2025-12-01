<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Monitoring Project Map</title>

<style>
    #map {
        width: 100%;
        height: 92vh; /* hampir fullscreen */
    }

    #lastUpdateBox {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(255, 255, 255, 0.9);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 14px;
        z-index: 9999;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="position-relative">

    <div id="lastUpdateBox">
        Last Update: <span id="lastUpdate">-</span>
    </div>

    <div id="map"></div>

</div>

</body>

{{-- @section('scripts') --}}

<script>
    let map;
    let infoWindow;
    let markers = {}; // menyimpan marker berdasarkan contract ID

    function initMap() {
        const initialPos = { lat: -6.3588186, lng: 108.3829766 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialPos,
            zoom: 20,
            mapTypeId: "roadmap",
            gestureHandling: "greedy",
        });

        infoWindow = new google.maps.InfoWindow();

        loadMarkers(); // pertama kali load
        setInterval(loadMarkers, 5000); // auto refresh setiap 5 detik
    }

    function loadMarkers() {
        fetch("{{ route('display.contract.locations') }}")
            .then(response => response.json())
            .then(res => {
                if (!res.success) return;

                res.data.forEach(item => {
                    const pos = {
                        lat: parseFloat(item.latitude),
                        lng: parseFloat(item.longitude)
                    };

                    // Jika marker belum ada → buat
                    if (!markers[item.id]) {
                        markers[item.id] = new google.maps.Marker({
                            map: map,
                            position: pos,
                            title: item.contract_number,
                            icon: {
                                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                                scaledSize: new google.maps.Size(32, 32)
                            }
                        });

                        // Klik marker → tampilkan popup
                        markers[item.id].addListener("click", () => {
                            infoWindow.setContent(`
                                <strong>${item.contract_number}</strong><br>
                                ${item.job_title ?? '-'}<br><br>
                                Lat: ${item.latitude}<br>
                                Lng: ${item.longitude}
                            `);
                            infoWindow.open(map, markers[item.id]);
                        });

                    } else {
                        // Jika sudah ada → cukup update posisi
                        markers[item.id].setPosition(pos);
                    }
                });

                // Update indikator waktu
                document.getElementById("lastUpdate").textContent =
                    new Date().toLocaleTimeString();
            })
            .catch(err => console.error(err));
    }

    window.onload = initMap;
</script>

<!-- GOOGLE MAPS API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVO8sQvPqRrCTLrRluyyPW8HW2waJke88&libraries=places"></script>

{{-- @endsection --}}
