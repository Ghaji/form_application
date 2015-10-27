jQuery.noConflict();
jQuery(document).ready(function(){
	
	var formclass = jQuery('.acceptance_log_details');
	
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
		//jQuery(".modal .ajax_data").html("<pre>"+msg+"</pre>");
		//jQuery(".modal").modal("show");
		jQuery(".modal-body").removeClass("loader");
		jQuery(" .modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}
	
jQuery("#insert").click(function(e) {
 jQuery.validator.setDefaults({
	submitHandler: function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_acceptance_insert.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	}
 }); 
 jQuery(formclass).validate(
 {
  rules: {
	applicant_number: {
      required: true,	  
    },
	payment_reference: {
      required: true,	  
    },
	response_code: {
      required: false,	  
    },
	amount: {
      required: true,	  
    },
	student_status: {
      required: true,	  
    }
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
});//end of onclick jquery for update button

jQuery("#insert_acc").click(function(e) {
	console.log('insert_acc');
 jQuery.validator.setDefaults({
	submitHandler: function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_acceptance_insert_acc.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	}
 }); 
 jQuery(formclass).validate(
 {
  rules: {
	applicant_number: {
      required: true,	  
    },
	payment_reference: {
      required: true,	  
    },
	response_code: {
      required: false,	  
    },
	amount: {
      required: true,	  
    },
	student_status: {
      required: true,	  
    }
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
});//end of onclick jquery for update button

}); // end document.ready// JavaScript Document