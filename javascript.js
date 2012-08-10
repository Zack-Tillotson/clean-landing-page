$(document).ready(function() {
	addfeed('github', 'https://github.com/Zack-Tillotson.atom');
	addfeed('blog', 'http://www.excitedmuch.com/blog/feed/');
	addfeed('china', 'http://www.laowaigonewild.com/feed/');
});

function addfeed($e, $url) {

	var $d = $e + "-feed";
	
	$("h1").after('<div class="feed" id="' + $d + '"><img class="loading" src="/resources/loading.gif" /></div>');
	$("#" + $d).hide();

	// Show feed div
	$("#" + $e).hover(function() {
		$("#" + $d).slideToggle("fast");
		$("#links").css("border-top", "solid 2px black");
	}, function() {
		$("#" + $d).slideToggle("fast");
		$("#links").css("border-top", "solid 5px black");
	});
	
	// Add content to feed div
	$("#" + $d).load("displayfeed.php?feed=" + $url);

}
