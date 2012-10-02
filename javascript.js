$(document).ready(function() {
	addfeed('github', 'https://github.com/Zack-Tillotson.atom');
	addfeed('blog', 'http://zacherytillotson.com/blog/feed/');
	addfeed('china', 'http://www.laowaigonewild.com/feed/');
	//addfeed('james', 'http://james.gioiafamily.us/feeds/posts/default?alt=rss');
});

function addfeed($linkurl, $url) {

	var $d = $linkurl + "-feed";
	
	$("h1").after('<div class="feed" id="' + $d + '"><img class="loading" src="/resources/loading.gif" /></div>');
	$("#" + $d).hide();

	// Show feed div
	$("#" + $linkurl).hover(function() {
		$("#" + $d).slideToggle("fast");
	}, function() {
		$("#" + $d).slideToggle("fast");
	});
	
	// Add content to feed div
	$("#" + $d).load("feedgraph.php?feed=" + $url + "&container=" + $d);

}
