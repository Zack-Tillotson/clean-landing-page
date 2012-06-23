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

include('src/simplepie.inc');

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
<?php echo (empty($_GET['feed'])) ? 'Atom Feed' : $feed->get_title(); ?><span>Displaying <?php echo $feed->get_item_quantity(); ?> most recent entries.</span>
<div class="feed-results">
	<?php if ($feed->data): ?>
		<?php $items = $feed->get_items(); ?>
		<?php foreach($items as $item): ?>
			<div class="a-feed-item">
				<h4><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a> <?php echo $item->get_date('j M Y'); ?></h4>
				<?php echo $item->get_content(); ?>
			</div>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
