jQuery.noConflict();
jQuery(document).ready(function(){
 
 jQuery("#close").click(function(){
	jQuery(".modal").modal("hide");
 });
 
 jQuery("#done").click(function(){
	jQuery(".modal").modal("hide");
 });
 
 
 function show_modal(){
		jQuery(" .modal-body").html("<center class='loading'>Loading Please Wait...</center>");
		jQuery(" .modal-body").addClass("loader");
		jQuery("#displayinfo").modal("show");
	}
	
	function display_modal(msg){
		jQuery(".modal-body").removeClass("loader");
		jQuery(" .modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}
 
 jQuery("#eligibility_submit").click(function() {
 	jQuery.validator.setDefaults({
		submitHandler: function() { 
			show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_post_eligibility.php",
			  data: jQuery(".eligibility").serialize()
			}).done(function( msg ) {
				display_modal(msg);
			});
		}
	 }); 
	 jQuery('.eligibility').validate(
	 {
	  rules: {
		// eligibility_status: {
	      // required: true
	    // },
		// reason: {
	      // required: true,
		  // minlength: 6
	    // }
	  },
	  errorClass: "help-inline",
	  highlight: function(label) {
	    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
	  },
	  success: function(label) {
	    label
	      .text('OK!').addClass('valid')
	      .closest('.control-group').addClass('success');
	  }
	 });
 });
 
 jQuery("#eligibility_status").change(function() {
 	var select_reason = jQuery('select[name=reason]');
 	if(jQuery(this).val() == 2) {
 		select_reason.removeAttr("disabled");
 	} else {
		select_reason.val('');
 		select_reason.attr("disabled","disabled");
 	}
 });
}); // end document.ready