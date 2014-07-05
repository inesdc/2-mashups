function initialize() {
    var mapOptions = {
        zoom: 6,
        center: new google.maps.LatLng(50.8560, 2.32111)
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);
    setMarkers(map, cities);
    infowindow = new google.maps.InfoWindow({
                content: "loading..."
            });
}
var cities = [
  ['Leeds', 53.799722, -1.549167, 3],
  ['Harrogate', 53.991, -1.539, 2],
  ['York', 53.95, -1.083333, 1],
];


function setMarkers(map, locations) {
  // Add markers to the map
  //add url of the flag image --& uncomment icon option for var = marker--
  var image = 'secure.jpg';

  for (var i = 0; i < locations.length; i++) {
    var city = locations[i];
    var myLatLng = new google.maps.LatLng(city[1], city[2]);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        //icon: image,
        title: city[0],
        zIndex: city[3],
    });
  }
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
/*
        setMarkers(map, sites);
        infowindow = new google.maps.InfoWindow({
                content: "loading..."
            });

        var bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
    }

    var sites = [
    ['Mount Evans', 39.58108, -105.63535, 4, 'This is Mount Evans.'],
    ['Irving Homestead', 40.315939, -105.440630, 2, 'This is the Irving Homestead.'],
    ['Badlands National Park', 43.785890, -101.90175, 1, 'This is Badlands National Park'],
    ['Flatirons in the Spring', 39.99948, -105.28370, 3, 'These are the Flatirons in the spring.']
];



    function setMarkers(map, markers) {

        for (var i = 0; i < markers.length; i++) {
            var sites = markers[i];
            var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
            var marker = new google.maps.Marker({
                position: siteLatLng,
                map: map,
                title: sites[0],
                zIndex: sites[3],
                html: sites[4]
            });

            var contentString = "Some content";

            google.maps.event.addListener(marker, "click", function () {
                alert(this.html);
                infowindow.setContent(this.html);
                infowindow.open(map, this);
            });
        }
    }*/