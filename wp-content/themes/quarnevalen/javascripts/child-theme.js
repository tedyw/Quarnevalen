/**
 * Here goes all the JS Code you need in your child theme buddy!
 */
(function($) {

	function setHeight(){
		
	};

	$(document).ready(function() {
		$(".hint").click(function(){
			$(".hsp").toggleClass("active");
		});

	    $(".pt-trigger").on("click", ".button", function() {
	    	$('.reveal-modal').trigger('reveal:close');
	    });
 	});

}(jQuery));