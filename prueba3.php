<!-- posibles mejoras

- cambiar el mapa en modo satelite
- cambiar la imagen del marcador
- cambiar el contenido de la burbuja (html)
- que las burbujas de texto se cierren



 -->
 <?php 
$apikey="c8abcb2729a2b86f6c4a3492299cdeaf";
$uri="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=dog&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";


$data=file_get_contents($uri);
$object = json_decode( $data ); 
 ?>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	var map;

  function initialize() {
    var latlng = new google.maps.LatLng(41, 2);
    var myOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP   //MapTypeId.SATELLITE,
    };
     map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	

	//var marker=createMarker(new google.maps.LatLng(41.5,2),"esto es una prueba");
	
	//createMarker(new google.maps.LatLng(41.3,2.1),"esto es otra prueba");
	
  }
  
  
  //crea un marker con una burbuja de texto, y una imagen personalizada
  function createMarker(point, txt) {
	  var image = 'img/coffee.png';
	  var marker = createMarker(point,"<div class=\"infowindow\"><h3>Infowindow Content</h3><p>This example produces a lightbox for a single image.</p><div>
	  		<?php

			foreach($object->photos->photo as $p){
			?>


			<div id="photo" style="display:block; float:left; width:90px;">
				<?php echo $p->title; ?>
				<img width="100" src="<?php echo $p->url_m; ?>">
				
			</li>
			</div>
			<?php
			}
			?>
	  	</div>")
      map.addOverlay(marker);

	

	var infowindow = new google.maps.InfoWindow({
		content: txt
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});
	
	
	return marker;
   }


</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>