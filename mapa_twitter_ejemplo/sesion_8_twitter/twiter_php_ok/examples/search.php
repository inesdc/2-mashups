<?php

require_once '../src/twitter.class.php';


// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter(
	"BonVHhko88hrx5ok10wIyp7cm",
	 "H9rE3IZKhzex1H0BHpkJNRjzh4GawfU2w07f2e0ctGEFsjlnMO",
	  "6691632-CliBVlnKa3PQKg2p0VjMe8mZleBwnu0p1qZk9CQqeX",
	   "HOSQDZAnBaNoCzuc2DwU44sDPmBNp8y6u1h43jrwawVQI");

$results = $twitter->search('#elbulli');
// or use hashmap: $results = $twitter->search(array('q' => '#nette', 'geocode' => '50.088224,15.975611,20km'));

?>
<!doctype html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Twitter search demo</title>

<ul>
<?php foreach ($results as $status): ?>
	<?php //para mostrar los campos disponibles print_r($status); ?>

	<li><a href="http://twitter.com/<?php echo $status->user->screen_name ?>"><img src="<?php echo htmlspecialchars($status->user->profile_image_url) ?>">
		<?php echo htmlspecialchars($status->user->name) ?></a>:
		<?php echo Twitter::clickable($status) ?>
		<small>at <?php echo date("j.n.Y H:i", strtotime($status->created_at)) ?></small>
	</li>
<?php endforeach ?>
</ul>
