<?php
//mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);


//$tag=$_GET['tag'];
$lat=42;
$lon=2;

$tag="bike";

$apikey="c8abcb2729a2b86f6c4a3492299cdeaf";
$uri="https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$apikey."&tags=".$tag."&lat=".$lat."&lon=".$lon."&extras=url_m,tags&format=json&nojsoncallback=1";

$data=file_get_contents($uri);
$object = json_decode( $data ); // stdClass object

//aqui ya tengo los datos en un array de php
//print_r($object);
?>

<?php
foreach($object->photos->photo as $p){
?>


<li>
	<?php echo $p->title; ?>
	<img width="100" src="<?php echo $p->url_m; ?>">

	<?php 
	$tags=explode(" ",$p->tags);
	foreach($tags as $tag){
		print "<a href='leer_json_flickr.php?tag=".$tag."'>".$tag."</a> ";
	}
	 ?>
	
</li>


<?php
}
?>




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
