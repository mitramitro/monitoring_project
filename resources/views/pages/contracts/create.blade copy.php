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
                    <input id="searchInput" type="text" class="form-control" placeholder="Search location...">
                </div>

                <div id="map" style="width: 100%; height: 400px; margin-bottom: 20px;"></div>

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
    let map, marker;

    function initMap() {
        // Default center
        const defaultLocation = { lat: -6.355, lng: 108.325 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 15,
            mapTypeId: "satellite",
        });

        marker = new google.maps.Marker({
            map: map,
            position: defaultLocation,
            draggable: true
        });

        // Update form when marker dragged
        google.maps.event.addListener(marker, 'dragend', function (event) {
            updateCoordinates(event.latLng.lat(), event.latLng.lng());
        });

        // Search box
        const searchBox = new google.maps.places.SearchBox(document.getElementById("searchInput"));

        searchBox.addListener("places_changed", function () {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];

            map.setCenter(place.geometry.location);
            marker.setPosition(place.geometry.location);

            updateCoordinates(place.geometry.location.lat(), place.geometry.location.lng());
        });
    }

    function updateCoordinates(lat, lng) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;
    }

    window.onload = initMap;
</script>

@endpush
