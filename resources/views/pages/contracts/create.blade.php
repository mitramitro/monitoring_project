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
                    <select class="single-select" name="company_id" required>
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
                    <label>PIC</label>
                    <input type="text" name="pic" class="form-control"> 
                </div>
                <div class="mb-3">
                    <label>Safety Man</label>
                    <input type="text" name="safety_man" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Handphone</label>
                    <input type="text" name="handphone" class="form-control">   
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="progress">Progress</option>
                        <option value="finish">Finish</option>
                    </select>
                </div>

                 <!-- ===================== MAP SECTION ======================= -->

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
                                <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                            </div>

                            <div class="mb-3">
                                <label>Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                            </div>

                        </div>

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
    let map, marker, infoWindow;

    function initMap() {
        const defaultLocation = { lat: -6.358818631177204, lng: 108.38297667254629 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 17,
            mapTypeId: "satellite",

            // Agar scroll langsung zoom (tidak keluar Ctrl+Scroll)
            gestureHandling: "greedy",
            scrollwheel: true
        });

        infoWindow = new google.maps.InfoWindow();

        // MARKER UTAMA
        marker = new google.maps.Marker({
            map: map,
            position: defaultLocation,
            draggable: true,
            icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
        });

        google.maps.event.addListener(marker, "dragend", function (event) {
            updateCoordinates(event.latLng.lat(), event.latLng.lng());
            showPinInfo(marker.getPosition());
        });

        // KLIK MAP → PIN PINDAH
        google.maps.event.addListener(map, "click", function (e) {
            marker.setPosition(e.latLng);
            updateCoordinates(e.latLng.lat(), e.latLng.lng());
            showPinInfo(e.latLng);
        });

        // SEARCH BOX
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
        pixelOffset: new google.maps.Size(0, -30) // geser bubble 30px ke atas
    });

    infoWindow.open(map);
}

    window.onload = initMap;
</script>

@endpush
