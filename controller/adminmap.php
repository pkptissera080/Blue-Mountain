<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAHnWEwVyPbcEZwJytQNsQyQLH8JXfyKa0">
</script>

<script>
    /**
     * Create new map
     */
    var infowindow;
    var map;
    var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var purple_icon = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
    var myOptions = {
        zoom: 7,
        center: new google.maps.LatLng(7.752484, 80.729071),
        mapTypeId: 'roadmap'
    };
    map = new google.maps.Map(document.getElementById('map'), myOptions);


    var markers = {};

    var getMarkerUniqueId = function(lat, lng) {
        return lat + '_' + lng;
    };

    var getLatLng = function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    };

    var prevmarker = 0;
    var prevmarkerid = 0;
    var addMarker = google.maps.event.addListener(map, 'click', function(e) {
        var lat = e.latLng.lat(); // lat of clicked point
        var lng = e.latLng.lng(); // lng of clicked point
        var markerId = getMarkerUniqueId(lat, lng); // an that will be used to cache this marker in markers object.
        var marker = new google.maps.Marker({
            position: getLatLng(lat, lng),
            map: map,
            animation: google.maps.Animation.DROP,
            id: 'marker_' + markerId
        });

        document.getElementById("latinfo").value = lat;
        document.getElementById("lnginfo").value = lng;

        markers[markerId] = marker; // cache marker in markers object
        bindMarkerEvents(marker);

        var newvmarkerid = getMarkerUniqueId(lat, lng);
        if (prevmarkerid == 0) {
            prevmarker = marker;
            prevmarkerid = newvmarkerid;
        } else {
            removeMarker(prevmarker, prevmarkerid);
            prevmarker = marker;
            prevmarkerid = newvmarkerid;
        }

    });

    var bindMarkerEvents = function(marker) {
        google.maps.event.addListener(marker, "rightclick", function(point) {
            var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng()); // get marker id by using clicked point's coordinate
            var marker = markers[markerId]; // find marker
            removeMarker(marker, markerId); // remove it
            document.getElementById("latinfo").value = '';
            document.getElementById("lnginfo").value = '';

        });
    };

    var removeMarker = function(marker, markerId) {
        marker.setMap(null); // set markers setMap to null to remove it from map
        delete markers[markerId]; // delete marker instance from markers object
    };
</script>