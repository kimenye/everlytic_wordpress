(function($) {

	$(document).ready(function(){
		// console.log("Preparing click handlers");
		var success_url = setting.success_url;
		// console.log("URL: ", success_url);
		if (success_url == window.location) {
			$('.mail-icon').hide();
		}

		$('.mail-icon').click(function() {
	    
	    	if ($('.newsletter').hasClass('active')) {
	        	//attempt to post
		    }
	    	else {
	      		$('.newsletter').addClass('active');
	    	}
	 	});
	});
})(jQuery);