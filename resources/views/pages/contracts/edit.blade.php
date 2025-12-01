@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Edit Contract</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Contract Number</label>
                    <input type="text" name="contract_number" value="{{ $contract->contract_number }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Company</label>
                    <select class="form-control" name="company_id" required>
                        @foreach($companies as $c)
                            <option value="{{ $c->id }}" {{ $c->id == $contract->company_id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Job Title</label>
                    <input type="text" name="job_title" value="{{ $contract->job_title }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Budget</label>
                    <input type="text" name="budget" value="{{ $contract->budget }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="progress" {{ $contract->status == 'progress' ? 'selected' : '' }}>Progress</option>
                        <option value="finish" {{ $contract->status == 'finish' ? 'selected' : '' }}>Finish</option>
                    </select>
                </div>
                <div class="row">

                    <!-- LEFT: MAP -->
                    <div class="col-md-6">
                        <div style="position: relative;">
                            <input id="searchInput" 
                                type="text" 
                                class="form-control"
                                placeholder="Search location..."
                                style="position:absolute; top:10px; left:10px; z-index:999; width:40%; margin-top:5px;">
                            
                            <div id="map" style="width: 100%; height: 50vh;"></div>
                        </div>
                    </div>

                    <!-- RIGHT: LAT/LNG INPUT -->
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label>Latitude</label>
                            <input type="text" id="latitude" name="latitude" 
                                class="form-control"
                                value="{{ $contract->latitude ?? '' }}" >
                        </div>

                        <div class="mb-3">
                            <label>Longitude</label>
                            <input type="text" id="longitude" name="longitude" 
                                class="form-control"
                                value="{{ $contract->longitude ?? '' }}" >
                        </div>

                    </div>

                </div>




                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVO8sQvPqRrCTLrRluyyPW8HW2waJke88&libraries=places"></script>

<script>
    let map, marker, infoWindow;

    function initMap() {

        // Ambil value dari input form
        const latVal = document.getElementById("latitude").value;
        const lngVal = document.getElementById("longitude").value;

        const hasCoordinates = latVal !== "" && lngVal !== "";

        // Jika ada koordinat → pakai itu
        // Jika kosong → pakai default Indramayu
        const initialLocation = hasCoordinates
            ? { lat: parseFloat(latVal), lng: parseFloat(lngVal) }
            : { lat: -6.358818631177204, lng: 108.38297667254629 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialLocation,
            zoom: hasCoordinates ? 17 : 14,
            mapTypeId: "satellite",

            gestureHandling: "greedy",
            scrollwheel: true,
        });

        infoWindow = new google.maps.InfoWindow();

        // ============================
        // MARKER (HANYA JIKA ADA KOORDINAT)
        // ============================
        marker = new google.maps.Marker({
            map: map,
            position: hasCoordinates ? initialLocation : null,
            draggable: true,
            visible: hasCoordinates,
            icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
        });

        // Jika marker sudah ada (ada koordinat)
        if (hasCoordinates) {
            google.maps.event.addListener(marker, "dragend", function(event) {
                updateCoordinates(event.latLng.lat(), event.latLng.lng());
                showPinInfo(event.latLng);
            });
        }

        // ============================
        // KLIK MAP → SET MARKER
        // ============================
        google.maps.event.addListener(map, "click", function(e) {
            marker.setPosition(e.latLng);
            marker.setVisible(true);

            updateCoordinates(e.latLng.lat(), e.latLng.lng());
            showPinInfo(e.latLng);
        });

        // ============================
        // SEARCH BOX
        // ============================
        const input = document.getElementById("searchInput");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        searchBox.addListener("places_changed", function () {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];

            map.setCenter(place.geometry.location);
            map.setZoom(18);

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            updateCoordinates(
                place.geometry.location.lat(),
                place.geometry.location.lng()
            );

            showPinInfo(place.geometry.location);
        });
    }

    function updateCoordinates(lat, lng) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
    }

    function showPinInfo(latLng) {
        const text = `Pin dropped at: ${latLng.lat().toFixed(8)}, ${latLng.lng().toFixed(8)}`;

        infoWindow.setOptions({
            content: text,
            position: latLng,
            pixelOffset: new google.maps.Size(0, -30)
        });

        infoWindow.open(map);
    }

    window.onload = initMap;
</script>


@endpush
