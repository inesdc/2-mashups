

<?php
if(isset($_GET['fruta'])==true){
 $fruta=$_GET['fruta'];
 echo $fruta;}
?>

<script>
function getFlickrPhotos(map, searchLat, searchLon) {

  var FLICKR_API_KEY = 'c8abcb2729a2b86f6c4a3492299cdeaf';

  var searchUrl = "https://api.flickr.com/services/rest/?method=flickr.photos.search&";
var fruta = "<php echo $fruta?>"
  var searchReqParams = {
    'api_key': FLICKR_API_KEY,
    'tags': <?php echo $fruta?>,
    'has_geo': true,
    
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
        document.write(data.photos);
       
      } else {
        
      }
      
    }
  })
  .fail(function(jqXHR, textStatus, errorThrown) {
    console.log('req failed');
    console.log('textStatus: ', textStatus, ' code: ', jqXHR.status);
  });
  
/*
  function getAndMarkPhotos(photos) {
    var numPhotos = photos.photo.length;
    for(var i=0; i<numPhotos; i++) {
      var photo = photos.photo[i];
      getPhotoLocation(photo.id);
    }
  }

  function getPhotoLocation(photoId) {
    var photoLocUrl = "https://api.flickr.com/services/rest/?method=flickr.photos.geo.getLocation&";

    var photoParams = {
      'api_key': FLICKR_API_KEY,
      'photo_id': photoId
    }

    $.ajax({
      type: 'GET',
      url : photoLocUrl,
      async: false,
      cache : true,
      crossDomain : true,
      dataType: 'xml',
      data: photoParams,
      success: function(data) {
        var location = $(data).find('location')[0];
        var photoLat = $(location).attr('latitude');
        var photoLon = $(location).attr('longitude');
        addOverlay(photoLat, photoLon, 'Flick Photo '+photoId, map);

      }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.log('req failed ', jqXHR);
      console.log('textStatus: ', textStatus, ' code: ', jqXHR.status);
    });

  }

  function addOverlay(lat, lon, text, map) {
    var myLatlng = new google.maps.LatLng(lat,lon);

    var marker = new google.maps.Marker({
      position: myLatlng,
      title:text
    });

    marker.setMap(map);
    //map.setCenter(myLatLng);
  }
}
</script>