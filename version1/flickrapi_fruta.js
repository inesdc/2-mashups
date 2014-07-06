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
