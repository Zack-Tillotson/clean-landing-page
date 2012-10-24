<script src="/resources/jquery-1.7.2.min.js"></script>
<script src="/resources/highcharts.js"></script>
<div id="container"></div>
<?php
date_default_timezone_set(date_default_timezone_get());

$SEASONS = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

function seasoncmp($a, $b) {

	global $SEASONS;

	$a_pieces = explode(' ', $a);
	$a_year = $a_pieces[0];
	$a_season = $a_pieces[1];
	
	$b_pieces = explode(' ', $b);
	$b_year = $b_pieces[0];
	$b_season = $b_pieces[1];

	if(strcmp($a_year, $b_year) != 0) {

		return strcmp($a_year, $b_year);

	} else {

		error_reporting(0); // Sqaush weird warnings
		$a_season_index = array_search($a_season, $SEASONS);
		$b_season_index = array_search($b_season, $SEASONS);
		error_reporting(-1);

		return $a_season_index - $b_season_index;

	}

}

// Get the feed 
$json_url = $_GET['feed'];
$json = file_get_contents("http://" . $_SERVER['SERVER_NAME'] . "/resources/RssToJson.php?feed=" . $json_url, 0, null, null);
$json_output = json_decode($json);

// Parse the feed
$month_counts = array();

foreach($json_output->items as $item) {

	$year_month = date("Y", $item->date) . " " . $SEASONS[date('n', $item->date) - 1];
	if(isset($month_counts[$year_month])) {
		$month_counts[$year_month]++;
	} else {
		$month_counts[$year_month] = 1;
	}

}

// Fill in the empty times
for($year = date('Y'); $year > date('Y') - 2 ; $year--) {
	for($season = 11 ; $season >= 0 ; $season--) {

		$nowwhen = date('Y') . " " . $SEASONS[date('n') - 1];
		$thenwhen = date($year) . " " . $SEASONS[$season];

		if(seasoncmp($nowwhen, $thenwhen) < 0) {
			continue;
		}
		$ks = array_keys($month_counts);

		if(seasoncmp($thenwhen, $ks[sizeof($ks)-1]) <= 0) {
			break 2;
		}

		if(!isset($month_counts[$thenwhen])) {
			$month_counts[$thenwhen] = 0;
			uksort($month_counts, "seasoncmp");
		}

	}
}

// Sort
uksort($month_counts, "seasoncmp");

$container= $_GET['container'];
?>
<script>
var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: '<?php print $container; ?>',
            type: 'line',
	    height: 300,
         },
         title: {
            text: 'Activity'
         },
         xAxis: {
            categories: [
<?php
	$is_first = true;
	foreach(array_keys($month_counts) as $season) { 
?>
		<?php echo ($is_first ? "" : ", "); ?><?php echo "'$season'"; ?> 
<?php
		$is_first = false; 
	}
?>
		]
         },
         yAxis: {
	    min: 0,
	    tickInterval: 1,
            title: {
               text: 'Activity'
            }
         },
         series: [{
	    showInLegend: false,
            data: [
<?php
	$first = true;
	foreach($month_counts as $month_count) {
?>
		<?php if(!$first) { print ","; } $first = false; ?>{
			y: <?php print $month_count; ?>
		}
<?php
		
	}
?>
         ]}]
      });
   });
</script>
