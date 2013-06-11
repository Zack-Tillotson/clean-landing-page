$(document).ready(function() {
  #addfeed('blog', 'http://zacherytillotson.com/blog/feed/');
  #addfeed('china', 'http://www.laowaigonewild.com/feed/');
});

function addfeed($linkurl, $url) {

	var $d = $linkurl + "-feed";

	// Create the div for this feed	
	$("#links").append('<div class="feed" id="' + $d + '"><img class="loading" src="/resources/loading.gif" /></div>');
	$("#" + $d).hide();

	// Add logic to show div when the link is hovered over
	$("#" + $linkurl).hover(function() {
		$("#" + $d).slideToggle("fast");
	}, function() {
		$("#" + $d).slideToggle("fast");
	});
	
	// Add content to feed div
	$("#" + $d).load("/resources/RssActivityGraph.php?feed=" + $url + "&container=" + $d);

}
