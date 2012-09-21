<?php

include('resources/simplepie.inc');

// Parse it
$feed = new SimplePie();
if (!empty($_GET['feed']))
{
	if (get_magic_quotes_gpc())
	{
		$_GET['feed'] = stripslashes($_GET['feed']);
	}
	$feed->set_feed_url($_GET['feed']);
	$feed->init();
}
$feed->handle_content_type();

?>
{"items":[
<?php 
	$first_item = 1;
	if ($feed->data) { 
?>
<?php 
		foreach($feed->get_items() as $item):
		if($first_item == false) {
?>
,
<?php
		}
		$first_item = false;
?>
	{
		"link":"<?php echo $item->get_permalink(); ?>",
		"title":"<?php echo $item->get_title(); ?>",
		"date":"<?php echo $item->get_date('U'); ?>"
	}
	<?php endforeach; ?>
<?php } ?>
]}
