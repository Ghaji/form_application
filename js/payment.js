jQuery.noConflict();
jQuery(document).ready(function(){
	var transaction_response_code = "021";
	var response_description = "Transaction Pending";
	var action = "insertlog";

	jQuery('#submit_payment').on('click', function () {
    	var form = jQuery('.payment_form');
		
		jQuery.ajax({
		  type: "POST",
		  url: "inc/ajiya/ws_ajax.php",
		  data: form.serialize() + "&ResponseCode=" + transaction_response_code + "&ResponseDescription=" + response_description + "&action=" + action
		}).done(function ( msg ) {
			// console.log(msg);
		    // setTimeout(function () {
		       jQuery('.payment_form').submit();
		    // }, 1000);
		});

	    return false;
	});	
});