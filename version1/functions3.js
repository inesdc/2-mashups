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



    //llamada a la api de flickr
    var apikey= "c8abcb2729a2b86f6c4a3492299cdeaf";
    var tag=tag;
        
    //fotos ordenadas por interés
     $.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key="+apikey+"&tags="+tag+"&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5",
        function(data){
            console.log(data);
            console.log("He encontrado fotos: ",data.photos.photo.length)
            $.each(data.photos.photo, function(i,item) {
          
                var html="<img width='200' src='"+item.url_m+"'>"+item.title;
           
                //imagen en pequeño
                var mini=item.url_m.replace(".jpg","_s.jpg");

                createMarker(map,new google.maps.LatLng(
                    item.latitude,
                    item.longitude),
                    mini,
                    html);
            });
        });
 }

 /*

    var markers = [
        ['Foto-1', 'foto1.jpg', 41.383585, 2.181600, 'Sentado en las rodillas de papá'],
        ['Foto-2', 'foto2.jpg', 41.400432, 2.140926, 'Jugando en casa de los tíos'],
        ['Foto-3', 'foto3.jpg', 41.383685, 2.181700, 'Riendo muy fuerte']
    ];
                                
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][2], markers[i][3]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent('<div class="info_content"><h3>'+markers[i][0]+'</h3><img src="'+markers[i][1]+'" width=100px><p>'+markers[i][4]+'</p></div>');
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}

*/