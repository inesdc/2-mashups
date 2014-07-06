
function getFlickrPhotos(map, tag) {

  var FLICKR_API_KEY = 'c8abcb2729a2b86f6c4a3492299cdeaf';

  var searchUrl = "https://api.flickr.com/services/rest/?method=flickr.photos.search&";

  var searchReqParams = {
    'api_key': FLICKR_API_KEY,
    'tags': tag,
    'has_geo': true,
    'lat': searchLat,
    'lon': searchLon,
    //'place_id': place.place_id,
 
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
        addOverlay(photoLat, photoLon, 'Flick Photo '+photoId, map); //array

      }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.log('req failed ', jqXHR);
      console.log('textStatus: ', textStatus, ' code: ', jqXHR.status);
    });

  }
  $(document).ready(function() {
  $('#warning').hide();
  $('#search').on('click', function() {
    var tag = $('#tag').val();
    
  });

  $('#search').trigger('click');