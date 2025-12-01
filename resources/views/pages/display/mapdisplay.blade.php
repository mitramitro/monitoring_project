<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Map Display</title>

    <style>
        #map {
            width: 100%;
            height: 100vh;
        }

        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Optional: Untuk tampilan TV lebih clean */
        .gm-control-active, .gmnoprint, .gm-style-cc {
            display: none !important;
        }
    </style>

</head>
<body>
{{-- @dd($items); --}}
<div id="map" style="height: 100vh; width: 100%;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVO8sQvPqRrCTLrRluyyPW8HW2waJke88&libraries=places"></script>

<script>
    function initMap() {

        // Pusatkan peta ke IT Balongan
        const centerPoint = { lat: -6.361818631177204, lng: 108.38097667254629 };

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom:17.5,
            center: centerPoint,
            mapTypeId: "satellite",
        });

        // Data dari Laravel (contracts)
        const locations = @json($items);

        locations.forEach(item => {
            if (!item.contract.latitude || !item.contract.longitude) return;

            const marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(item.contract.latitude),
                    lng: parseFloat(item.contract.longitude)
                },
                map: map,
                title: item.contract.job_title,
                 
                label: {
                    text: item.contract.company ? item.contract.company.name : "-",
                    fontSize: "18px",
                    fontWeight: "bold",
                    color: "red",
                },
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                    labelOrigin: new google.maps.Point(15, 45),
                }
            });

            const info = new google.maps.InfoWindow({
                content: `
                    <strong>${item.contract.job_title}</strong><br>
                    Perusahaan: ${ item.contract.company?item.contract.company.name : "-"}<br>
                    Koordinat: ${item.contract.latitude}, ${item.contract.longitude}
                `
            });

            marker.addListener("click", () => {
                info.open(map, marker);
            });
        });
    }
     window.onload = initMap;
</script>

<!-- Google Maps API -->

</body>
</html>
