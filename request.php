

<?php
if(isset($_GET['fruta'])==true){
 $fruta=$_GET['fruta'];
 echo $fruta;}
?>

<script type="text/javascript">
var apiKey = '[c8abcb2729a2b86f6c4a3492299cdeaf]'
$.getJSON('http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=' + apiKey + '&tags='+'<?php echo $fruta?>'+'&extras=url_m,tags&format=json&nojsoncallback=1&per_page=5',

function(data){
        
//loop through the results with the following function
$.each(data.photoset.photo, function(i,item){
    var titulo = item.title;
    //var photo = item.url_m;
    //build the url of the photo in order to link to it
    var photoURL = 'http://farm' + item.farm + '.static.flickr.com/' + item.server + '/' + item.id + '_' + item.secret + '_m.jpg'
 
    //turn the photo id into a variable
    var photoID = item.id;
 
    //use another ajax request to get the geo location data for the image
    $.getJSON('http://api.flickr.com/services/rest/?&amp;method=flickr.photos.geo.getLocation&amp;api_key=' + apikey + '&amp;photo_id=' + photoID + '&amp;format=json&amp;jsoncallback=?',
    function(data){
 
        //if the image has a location, build an html snippet containing the data
        if(data.stat != 'fail') {
            var latitude = data.photo.location.latitude;
            var longitude = data.photo.location.longitude; 

        }
        
    });
    
}

var array_photo = new array ("titulo","photoURL","latitude","longitude");
for (i=0;i<4;i++){ 
    document.write(array_photo[i]) 
    document.write("<br>") 
}


</script>
<div>
<div>
  <script type="text/javascript">
  for (i=0;i<4;i++){ 
    document.write(array_photo[i]) 
    document.write("<br>") 
  </script>
</div>