
<?php
//mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);


//$tag=$_GET['tag'];
$location1="leeds";
$location2="barcelona";
$location3="york";
$radius="55km";

$tag="letour";

$apikey="c8abcb2729a2b86f6c4a3492299cdeaf";
$uri="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=".$tag."&location=".$location1."&radius=".$radius."&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";


$data=file_get_contents($uri);
$object = json_decode( $data ); // stdClass object


$uri2="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=".$tag."&tags=".$location2."&radius=".$radius."&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";
$data2=file_get_contents($uri2);
$object2 = json_decode( $data2 ); // stdClass object

$uri3="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=".$tag."&tags=".$location3."&location=".$location3."&radius=".$radius."&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";
$data3=file_get_contents($uri3);
$object3 = json_decode( $data3 ); // stdClass object


//aqui ya tengo los datos en un array de php
//print_r($object);
//?>
<!DOCTYPE HTML>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<body>
<div id="mapa">
	<?php 
	$photos=$object->photos
	echo $photos>
<button id="etapa">etapa</button>
<div id="photos" style="display:none; width:500px;">

<?php

foreach($object->photos->photo as $p){
?>


<div id="photo" style="display:block; float:left; width:90px;">
	<?php echo $p->title; ?>
	<img width="100" src="<?php echo $p->url_m; ?>">

	<!--<?php 
	$tags=explode(" ",$p->tags);
	foreach($tags as $tag){
		print "<a href='leer_json_flickr.php?tag=".$tag."'>".$tag."</a> ";
	}
	 ?>-->
	
</li>
</div>





<?php
}
?>
<?php

foreach($object2->photos->photo as $p2){
?>


<div id="photo" style="display:block; float:left; width:90px;">
	<?php echo $p2->title; ?>
	<img width="100" src="<?php echo $p2->url_m; ?>">

	<!--<?php 
	$tags=explode(" ",$p->tags);
	foreach($tags as $tag){
		print "<a href='leer_json_flickr.php?tag=".$tag."'>".$tag."</a> ";
	}
	 ?>-->
	
</li>
</div>





<?php
}
?>
<?php

foreach($object3->photos->photo as $p3){
?>


<div id="photo" style="display:block; float:left; width:90px;">
	<?php echo $p3->title; ?>
	<img width="100" src="<?php echo $p3->url_m; ?>">

	<!--<?php 
	$tags=explode(" ",$p->tags);
	foreach($tags as $tag){
		print "<a href='leer_json_flickr.php?tag=".$tag."'>".$tag."</a> ";
	}
	 ?>-->
	
</li>
</div>





<?php
}
?>
<button id="cerrar">cerrar</button>

</div>
<script type="text/javascript">
document.querySelector("#etapa").addEventListener("click", function(){
    document.querySelector("#photos").style.display = "block";

});
document.querySelector("#cerrar").addEventListener("click", function(){
    document.querySelector("#photos").style.display = "none";

});
</script>

</div>

<?php

//alternativa si no funciona file_get_contents (puede que no esté activado en el php)

function my_file_get_contents($url){
	$ch = curl_init(); // open curl session
	// set curl options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	$data = curl_exec($ch); // execute curl session
	curl_close($ch); // close curl session
	return $data;
}

?>
</body>
