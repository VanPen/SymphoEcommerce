var map;
function initMap() {
    var lyon = {lat: 45.764043, lng: 4.835659};
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 45.764043, lng: 4.835659},
        zoom: 13
    });
    var marker = new google.maps.Marker({
        position: lyon,
        map: map
    });
}
