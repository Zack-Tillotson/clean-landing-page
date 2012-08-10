<?php

function microtime_float()
{
	if (version_compare(phpversion(), '5.0.0', '>='))
	{
		return microtime(true);
	}
	else
	{
		list($usec, $sec) = explode(' ', microtime());
		return ((float) $usec + (float) $sec);
	}
}

$start = microtime_float();

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
<div class="title">Recent Activity</div>
<div class="content">
	<?php if ($feed->data): ?>
		<?php $items = $feed->get_items(); ?>
		<?php foreach($items as $item): ?>
			<div class="item-title">
				<a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a>
			</div>
			<div class="item-date">
				<?php echo $item->get_date('j M Y'); ?>
			</div>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
