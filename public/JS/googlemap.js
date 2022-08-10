
function desinationlocation(){
    var input=document.getElementById('deslocation');
    var autocomplete=new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('delvLat').value = place.geometry.location.lat();
        document.getElementById('delvLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', deslocation);

    function deliverylocation() {
    var input = document.getElementById('delvlocation');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('delvLat').value = place.geometry.location.lat();
        document.getElementById('delvLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', deliverylocation);