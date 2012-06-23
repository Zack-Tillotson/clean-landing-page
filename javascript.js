$(document).ready(function() {
	googletracking();
	addfeed('github', 'https://github.com/knick-knack.atom');
	addfeed('blog', 'http://www.excitedmuch.com/blog/feed/');
});

function googletracking() {
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-22535544-1']);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
}

function addfeed($e, $url) {

	var $d = $e + "-feed";
	
	$("h1").after('<div class="feed" id="' + $d + '"></div>');
	$("#" + $d).hide();

	// Show feed div
	$("#" + $e).hover(function() {
		$("#" + $d).slideToggle("fast");
	}, function() {
		$("#" + $d).slideToggle("fast");
	});
	
	// Add content to feed div
	$("#" + $d).load("displayfeed.php?feed=" + $url);

}
