<?php
//mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);


//$tag=$_GET['tag'];
+

$tag="letour";

$apikey="c8abcb2729a2b86f6c4a3492299cdeaf";
$uri="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=".$tag."&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";


$data=file_get_contents($uri);
$object = json_decode( $data ); // stdClass object





//aqui ya tengo los datos en un array de php
//print_r($object);
//?>
<!DOCTYPE HTML>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<body>
<div id="mapa" style="background-color:gray; width:100px ">
	<?php 
	$photos=$object->photos
	echo $photos->url_m>
	?>
</div>
</body>
</html>