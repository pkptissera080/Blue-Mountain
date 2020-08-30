<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyAHnWEwVyPbcEZwJytQNsQyQLH8JXfyKa0">
</script>

<script>
    var mylat = <?php echo $pro_lat ?>;
    var mylng = <?php echo $pro_lng ?>;
    var infowindow;
    var map;
    var red_icon = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    var purple_icon = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
    var myOptions = {
        zoom: 10,
        center: new google.maps.LatLng(mylat, mylng),
        mapTypeId: 'roadmap'
    };
    viewmap = new google.maps.Map(document.getElementById('viewmap'), myOptions);
    viewmarker = new google.maps.Marker({
        position: new google.maps.LatLng(mylat, mylng),
        map: viewmap,
        icon: red_icon
    });

    map = new google.maps.Map(document.getElementById('map'), myOptions);
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(mylat, mylng),
        map: map,
        icon: red_icon
    });


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

    function reloadMap() {
        document.getElementById("latinfo").value = mylat;
        document.getElementById("lnginfo").value = mylng;
        removeMarker(prevmarker, prevmarkerid);
    }
</script>