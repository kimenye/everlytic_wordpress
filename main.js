(function($) {

	$(document).ready(function(){

		console.log("Preparing click handlers");

		$('.mail-icon').click(function() {
	    
	    	if ($('.newsletter').hasClass('active')) {
	        // 
		    }
	    	else {
	      		$('.newsletter').addClass('active');
	    	}
	 	});

	 	$('.subscribe-form').submit(function(event) {
	    	// return;   
	    	debugger;
	    	event.preventDefault();
	 	});
	});
})(jQuery);