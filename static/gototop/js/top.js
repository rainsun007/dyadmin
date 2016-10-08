$(document).ready(function() {
	var defaults = {
		containerID: 'toTop', // fading element id
		containerHoverID: 'toTopHover', // fading element hover id
		scrollSpeed: 1200,
		easingType: 'easeOutQuart'  //linear  easeOutQuart 
	};
	
	$().UItoTop(defaults);
});
