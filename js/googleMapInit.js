$(document).ready(function () {

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
/* google */
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
function initialize() {
    var map_canvas = document.getElementById('googleMap');

    var map_options = {
        center: new google.maps.LatLng(29.527588, -98.424915),
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        scrollwheel: false
    };

    var map = new google.maps.Map(map_canvas, map_options);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(29.527588, -98.424915),
        map: map,
        title: 'Hello World!'
    });
    var styles = [
        
    ]
    map.setOptions({styles: styles});
}
google.maps.event.addDomListener(window, 'load', initialize);


});
