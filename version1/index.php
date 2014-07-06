<?php

$fruta=""; // evitamos el warning de undefined variable

if(isset($_GET['tag'])==true) { // sustituye el valor en $fruta si encuentra un valor válido por el atributo tag
 $fruta=$_GET['tag'];
}

$key = 'c8abcb2729a2b86f6c4a3492299cdeaf';
$uri="http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=".$key."&tags=".$fruta."&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5";



?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script>
		var tag="<?php echo $fruta;?>"; // si no se pone aquí no funciona ¿?
	</script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="functions3.js" type="text/javascript"></script>
</head>
<body>

<?php
if (isset ($fruta) and ($fruta!="")) {?>
<h1>Has buscado: <?php echo $fruta?></h1>
<h2>Mapa de fotos en Flickr de <?php echo $fruta?></h2>
<div id="map_wrapper">
    <div id="map_canvas" class="mapping"></div>
</div>
<?php } else { ?>
	
<form action="index.php" method="get">
	<label name="tag">Fruit finder</label>
  <input type="text" name="tag" ></input>
  <input type="submit"></input>
</form>



<?php } ?>

</body>
</html>