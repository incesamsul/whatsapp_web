// mendeteksi locasi pengguna ( langitude and lotitude )
navigator.geolocation.getCurrentPosition(
    function(position) {
        const key = "AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k";
        $.ajax({
            url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${position.coords.latitude},${position.coords.longitude}&key=${key}`,
            success: function(data) {
                initMap(position.coords.latitude, position.coords.longitude, data.results[0].formatted_address)
            }
        })

    },
    function errorCallback(error) {
        console.log(error)
        if (error.code == 1) {
            $('#ask-permission').addClass('show');
            // alert("Izinkan aplikasi untuk mengakses lokasi anda dan pastikan gps anda aktif");
        }
    },
);




// membuat fungsi callback initmap untuk google maps api
function initMap(lat = 0, lng = 0, address) {

    console.log(lat);
    console.log(lng);
    $('#latitude').val(lat);
    $('#longitude').val(lng);

    $('#inputposisi').val(address);

    var myLatLng = {
        lat,
        lng
    };


    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: myLatLng,
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
    });

    var infoWindow = new google.maps.InfoWindow({
        content: `<p>${address}</p>`,
    });

    infoWindow.open(map, marker);


}
