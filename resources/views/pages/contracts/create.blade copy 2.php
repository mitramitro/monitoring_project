@extends('layouts.default')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Add Contract</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('contracts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Contract Number</label>
                    <input type="text" name="contract_number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Company</label>
                    <select class="form-control" name="company_id" required>
                        <option value="">-- Select Company --</option>
                        @foreach($companies as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Job Title</label>
                    <input type="text" name="job_title" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Budget</label>
                    <input type="text" name="budget" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="progress">Progress</option>
                        <option value="finish">Finish</option>
                    </select>
                </div>

                <!-- ===================== MAP SECTION ======================= -->

                <div class="mb-3">
                    <label class="fw-bold">Search for a place here:</label>
                    <!-- Search box embedded inside map -->
                    <input id="searchInput" type="text" class="form-control" placeholder="Search location...">
                </div>

                <div id="map" style="width: 100%; height: 450px; margin-bottom: 20px; position: relative;"></div>

                <div class="mb-3">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                </div>

                <!-- ===================== END MAP SECTION ===================== -->


                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVO8sQvPqRrCTLrRluyyPW8HW2waJke88&libraries=places"></script>

<script>
    let map, mainMarker, dropMarker, infoWindow;

    function initMap() {
        const defaultLocation = {
            lat: -6.360453587380078,
            lng: 108.38298235625074
        };

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 16,
            mapTypeId: "satellite",
        });

        infoWindow = new google.maps.InfoWindow();

        // ==========================
        // MAIN MARKER (DRAGGABLE)
        // ==========================
        mainMarker = new google.maps.Marker({
            map: map,
            position: defaultLocation,
            draggable: true,
            icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
        });

        // Update koordinat ketika marker utama digeser
        google.maps.event.addListener(mainMarker, 'dragend', function(event) {
            setCoordinates(event.latLng.lat(), event.latLng.lng());
            showPinInfo(mainMarker.getPosition());
        });

        // ==========================
        // PIN DROPPED MARKER (Klik peta)
        // ==========================
        dropMarker = new google.maps.Marker({
            map: map,
            draggable: true,
            icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
        });

        google.maps.event.addListener(map, "click", function(e) {
            dropMarker.setPosition(e.latLng);
            setCoordinates(e.latLng.lat(), e.latLng.lng());
            showPinInfo(e.latLng);
        });

        // Drag on dropped marker
        google.maps.event.addListener(dropMarker, 'dragend', function(event) {
            setCoordinates(event.latLng.lat(), event.latLng.lng());
            showPinInfo(event.latLng);
        });

        // ==========================
        // SEARCH BOX (Dalam MAP)
        // ==========================
        const input = document.getElementById("searchInput");

        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        searchBox.addListener("places_changed", function() {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];
            map.setCenter(place.geometry.location);
            map.setZoom(18);

            dropMarker.setPosition(place.geometry.location);

            setCoordinates(
                place.geometry.location.lat(),
                place.geometry.location.lng()
            );

            showPinInfo(place.geometry.location);
        });
    }

    // ==========================
    // Helpers
    // ==========================
    function setCoordinates(lat, lng) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
    }

    function showPinInfo(latLng) {
        const text = `Pin dropped at: ${latLng.lat().toFixed(8)}, ${latLng.lng().toFixed(8)}`;
        infoWindow.setOptions({
            content: text,
            position: latLng,
            pixelOffset: new google.maps.Size(0, -30) // geser naik 30px
        });
        infoWindow.setContent(text);
        infoWindow.setPosition(latLng);
        infoWindow.open(map);
    }

    window.onload = initMap;
</script>

@endpush