jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    //Ines

    function getFlickrPhotos(map, tag) {

  var FLICKR_API_KEY = 'c8abcb2729a2b86f6c4a3492299cdeaf';

  var searchUrl = "https://api.flickr.com/services/rest/?method=flickr.photos.search&";

  var searchReqParams = {
    'api_key': FLICKR_API_KEY,
    'tags': barcelona,
    'has_geo': 1,
    'extras' : 'geo',   //'place_id': place.place_id,
    'accuracy': 11,
    'format': 'json',
    'safe_search': 1,
    'privacy_filter': 1,
    'per_page': 10
  }

  $.ajax({
    type: 'GET',
    url : searchUrl,
    dataType:'jsonp',
    cache : true,
    crossDomain : true,
    jsonp: false,
    jsonpCallback : 'jsonFlickrApi',
    data: searchReqParams,
    success: function(data) {
      if (data.photos.photo.length > 0) {
        getAndMarkPhotos(data.photos);
        $('#warning').hide();
      } else {
        console.log(data.photos);
        $('#warning').show();
      }
      
    }
  })
  .fail(function(jqXHR, textStatus, errorThrown) {
    console.log('req failed');
    console.log('textStatus: ', textStatus, ' code: ', jqXHR.status);
  });
  

  function getAndMarkPhotos(photos) {
    var numPhotos = photos.photo.length;
    for(var i=0; i<numPhotos; i++) {
      var photo = photos.photo[i];
      var lat = photos.photo.latitude;
      var lon = photos.photo.longitude;
      marker(photo.id, lat, lon);
    }
  }

  f
  function marker(lat, lon, text, map) {
    var myLatlng = new google.maps.LatLng(lat,lon);
    for(var i=0; i<numPhotos.length; i++) {
    var marker = new google.maps.Marker({
      position: myLatlng,
      title:text
    });
    var infoWindow = new google.maps.InfoWindow(), photo, i;

    google.maps.event.addListener(marker, 'click', (function(photo, i) {
            return function() {
                infoWindow.setContent('<div class="info_content"><h3>'+photo.title+'</h3><img src="'+photo.url_m'" width=100px></div>');
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    
    }
}


//fin ines
    // Multiple Markers
    /* marker[0]:       titulo de la foto (se muestra en la info_window como 'h3')
     * marker[1]:       url de la foto (se muestra en la info_window como 'img')
     * marker[2]y[3]:   Lat y Long de la foto
     * marker[4]:       Descripción de la foto (se muestra en info_window como 'p')
     */
    
    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}