"use strict";

function drawMapView(map_id, lat, lng, address){
    var map,
        zoom = 18,
        world;
    world = { lat: +lat, lng: +lng };
        map = new google.maps.Map(document.getElementById(map_id), {
            center: world,
            zoom: zoom
        });
            new google.maps.Marker({
            map: map,
            position: world,
            title: address
        });
}

function gdCalendarMapView() {
    var all_maps = jQuery(".map_view");
    if(all_maps.length){
        all_maps.each(function(){
            var id = jQuery(this).attr('id');
            var element = jQuery( "#"+id );
            var lat = element.parent().find("#latitude_view").val();
            var lng = element.parent().find("#longitude_view").val();
            var address = element.parent().find("#address_view").val();
                if( lat != 0 && lng != 0 ) {
                    if( address === '' ) {
                        var name = gdCalendarGetAddressByLocation(lat, lng),
                            self = this;
                            name.done(function (res){
                                var addr = jQuery(self).parent().find('.venue_location_name');
                                if(addr.text() == ""){
                                    addr.text(res);
                                }
                            }).fail(function (res) {
                                alert(res);
                            });
                    }
                    drawMapView(id, lat, lng, address);
                }
                else if(address !== ''){
                    gdCalendarGetLocationByAddress(id, address);
                }
                else{
                    document.getElementById(id).style.display = "none";
                }
        });
    }
}

function gdCalendarGetLocationByAddress(id, address){
    var latitude, longitude;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            latitude = results[0].geometry.location.lat();
            longitude = results[0].geometry.location.lng();
            drawMapView(id,latitude, longitude, address);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function gdCalendarGetAddressByLocation(lat, lng) {
    var def = jQuery.Deferred(),
    location = new google.maps.LatLng(lat,lng),
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'location': location}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var addr = results[0].formatted_address;
            def.resolve(addr);
        } else {
            def.reject('Geocode was not successful for the following reason: ' + status);
        }
    });
    return def.promise();
}

jQuery(document).ready(function () {
    gdCalendarMapView();
});