function initialize() {
	var map;
	var latlng = new google.maps.LatLng(41.39, 2.13);
	var myOptions = {
		zoom: 3,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.TERRAIN 
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	var tag=fruta;
	var apikey="c8abcb2729a2b86f6c4a3492299cdeaf";
	
	$.getJSON("https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key="+apikey+"&tags="+tag+"&per_page=500&sort=date-posted-desc&has_geo=1&extras=date_taken,owner_name,path_alias,views,geo,url_m&format=json&nojsoncallback=1",
	function(data){
		console.log(data);
		$.each(data.photos.photo, function(i,item) {
			var html="<p class='title'>"+item.title+"</p><a target='_blank' href='https://www.flickr.com/photos/"+item.pathalias+"/"+item.id+"'><img width='200' src='"+item.url_m+"'></a><ul class='details'>Autor: "+item.ownername+"</p>";
			var smallPhoto=item.url_m.replace(".jpg","_s.jpg"); // imagen en pequeño para aligerar la carga

			createMarker(map,new google.maps.LatLng(
				item.latitude,
				item.longitude),
				smallPhoto,
				html);
		});
	});
}
  
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
	
	google.maps.event.addListener(map, 'click', function() {
	  infowindow.close(map,marker);
	});
	
}
