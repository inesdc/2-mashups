<?php



$uri="https://api.instagram.com/v1/locations/search?lat=42&lng=2?client_id=99e92b11c3884ed480f063ccac83ac51";


$res=doCurl($uri);
$data=json_decode($res);




function doCurl($url){
	$ch = curl_init(); // open curl session
	// set curl options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	$data = curl_exec($ch); // execute curl session
	curl_close($ch); // close curl session
	return $data;
}
echo $data;

?>

