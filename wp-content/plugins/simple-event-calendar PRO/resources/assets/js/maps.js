"use strict";

(function () {
    var map,addmarker,
        map_div = document.getElementById('map'),
        zoom = 1,
        world = { lat: 42.3784077, lng: 21.8329331 },
        address = document.getElementById('address'),
        lat = document.getElementById('latitude'),
        lng = document.getElementById('longitude');

    function gdCalendarMap() {
        if( lat.value !== '' && lng.value !== '' ){
            // if( address.value === '' ){
                gdCalendarUpdateInputAddress(lat.value, lng.value);
            // }
            world = { lat: +lat.value, lng: +lng.value };
            zoom = 4;
            drawMap( world, zoom );
            if(map_div){
                gdCalendarPlaceMarker(world);
                map.setCenter(world);
            }
            return;
        }else if( address.value !== ''){
            gdCalendarInputAddress();
        }else{
            drawMap(world, zoom);
        }
    }

    function gdCalendarInputAddress(){
        var latitude, longitude, loc;
        var def = jQuery.Deferred();
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({'address': address.value}, function(results, status) {
            if (status === 'OK') {
                loc = results[0].geometry.location;
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();
                jQuery("#latitude").val(latitude);
                jQuery("#longitude").val(longitude);
                def.resolve();
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
        def.promise().done(function () {
            world = { lat: +latitude.value, lng: +longitude.value };
            zoom = 4;
            drawMap(world, zoom);
            if(map_div){
                gdCalendarPlaceMarker(loc);
                map.setCenter(loc);
            }
        });
    }

    function drawMap(world, zoom) {
        var autocomplete;

        if(map_div){
            map = new google.maps.Map(map_div, {
                center: world,
                zoom: zoom
            });
        }
        else{
            return false;
        }

        jQuery(".gd_calendar_map_coordinates").on('change', function() {
            world = { lat: +lat.value, lng: +lng.value };
            gdCalendarPlaceMarker(world);
            gdCalendarUpdateInputAddress(lat.value, lng.value);
        });

        autocomplete = new google.maps.places.Autocomplete((address),{types: ['geocode']});
        autocomplete.addListener('place_changed', gdCalendarInputAddress);
        google.maps.event.addDomListener(address, 'keydown', gdCalendarPreventKeyDown);
        google.maps.event.addListener(map, 'click', function (event) {
            gdCalendarPlaceMarker(event.latLng);
            gdCalendarUpdateInputAddress(event.latLng.lat(), event.latLng.lng());
        });
    }

    function gdCalendarPlaceMarker(location) {
        if(address) {
            var title = address.value;
        }
        if(addmarker) {
            addmarker.setMap(map);
            addmarker.setPosition(location);
        }
        else {
            addmarker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: location,
                title: title
            });
        }
        map.setCenter(location);
        // map.setZoom(zoom);

        google.maps.event.addListener(addmarker, 'drag', function (event) {
            gdCalendarUpdateInputAddress(event.latLng.lat(), event.latLng.lng());
        });
    }

    function gdCalendarUpdateInputAddress(lat, lng) {
        jQuery("#latitude").val(lat);
        jQuery("#longitude").val(lng);
        var location = new google.maps.LatLng(lat,lng);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'location': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var address = results[0].formatted_address;
                jQuery("#address").val(address);
            }
        });
    }

    function gdCalendarPreventKeyDown(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    }

    jQuery(document).ready(function () {
        gdCalendarMap();
    });
})();

