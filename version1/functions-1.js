jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

    var map; //fuera del contexto de las funciones para que sea siempre accesible
    var veces=0;

  function initialize() {
    var latlng = new google.maps.LatLng(41.39, 2.13);
    var myOptions = {
      zoom: 14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP   //MapTypeId.SATELLITE,
    };
     map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
     
     //evento que se llama cuando los límites del mapa han cambiado 
     google.maps.event.addListener(map, 'bounds_changed', function() {
        mapUpdated();
    });
    
    
    
    //llamada a la api de flickr
    var tag="<?php echo $fruta?>";
    var apikey="803c9828d52e6a1bb961e9d8b337caa1"; //cambiar por la vuestra
        
        //fotos ordenadas por interés
     $.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key="+apikey+"&tags="+tag+"&per_page=100&&has_geo=1&extras=date_taken,owner_name,views,geo,url_m&format=json&nojsoncallback=1",
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

  function mapUpdated(){
    veces++;
    //bounds=map.getBounds();
    
    var center=map.getCenter();

    $('#info').html(center.lat()+" "+center.lng());
    
  }
  
  //crea un marker con una burbuja de texto, y una imagen personalizada
  function createMarker(map,point,image, txt) {
      var marker = new google.maps.Marker({
          position: point,
          map: map,
          icon: image
      });

    

    var infowindow = new google.maps.InfoWindow({
        content: txt
    });
    google.maps.event.addListener(marker, 'click', function() {
        
      infowindow.open(map,marker);
    
    });
    
    
    return marker;
   }