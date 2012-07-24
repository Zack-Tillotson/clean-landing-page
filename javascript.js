$(document).ready(function() {
	googletracking();
	addfeed('github', 'https://github.com/Zack-Tillotson.atom');
	addfeed('blog', 'http://www.excitedmuch.com/blog/feed/');
	addfeed('china', 'http://www.laowaigonewild.com/feed/');
});

function googletracking() {
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-33622205-1']);
	_gaq.push(['_trackPageview']);

	(function() {

		var ga = document.createElement('script'); 
		ga.type = 'text/javascript'; 
		ga.async = true;
		ga.src = 'http://www.google-analytics.com/ga.js';

		var s = document.getElementsByTagName('script')[0]; 
		s.parentNode.insertBefore(ga, s);

	})();
}

function addfeed($e, $url) {

	var $d = $e + "-feed";
	
	$("h1").after('<div class="feed" id="' + $d + '"><img src="loading.gif" /></div>');
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
