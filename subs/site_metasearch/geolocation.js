var cidade = "";
var selectedDistrito = $('#selectedDistrito').val()
if ("geolocation" in navigator && selectedDistrito == "none") {
  navigator.geolocation.getCurrentPosition(function (position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Make an AJAX request to the Nominatim API
    var url = 'https://nominatim.openstreetmap.org/reverse?lat=' + latitude + '&lon=' + longitude + '&format=json';
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          cidade = response.address.city;
          console.log("Geolocation data fetched successfully:", cidade);
          if (cidade != "") {
            $('#concelho').val(cidade);
            $('#concelho').trigger('change');
            //$('#filter').submit();
          }
        } else {
          console.error("Error fetching geolocation data:", xhr.responseText);
        }
      }
    };
    xhr.send();
  });
} else {
  console.log("Geolocation is not supported by this browser.");
}
