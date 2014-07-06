<?php

$fruta=""; // evitamos el warning de undefined variable

if(isset($_GET['tag'])==true) { // sustituye el valor en $fruta si encuentra un valor válido por el atributo tag
 $fruta=$_GET['tag'];
}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script>
		var fruta="<?php echo $fruta;?>";
	</script>
	<script src="functions.js"></script>
</head>
<body onload="initialize()">
<?php
if (isset ($fruta) and ($fruta!="")) {?>
	<div id="info">
		<p>Has buscado: <?php echo $fruta?>
		<p>Mapa de fotos en Flickr de <?php echo $fruta?></p>
		<form action="index.php" method="get">
			<label name="tag">Busca otra fruta: </label>
			<input type="text" name="tag" ></input>
			<input type="submit"></input>
		</form>
	</div>
	<div id="map_canvas" style="width:100%; height:100%"></div>
<?php } else { ?>
	
	<form action="index.php" method="get">
		<label name="tag">Fruit finder</label>
	  <input type="text" name="tag" ></input>
	  <input type="submit"></input>
	</form>

<?php } ?>
</body>
</html>
