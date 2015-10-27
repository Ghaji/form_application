jQuery.noConflict();
jQuery(document).ready(function(){
	
	var formclass = jQuery('.adm_access_details');
	
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
	
jQuery("#update").click(function(e) {
 jQuery.validator.setDefaults({
	submitHandler: function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_adm_update.php",
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


jQuery("#update_acc").click(function(e) {
 jQuery.validator.setDefaults({
	submitHandler: function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_adm_acc_update.php",
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


jQuery("#clear_log_submit").click(function(e) {
	e.preventDefault();
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_delete_admaccess.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
});

jQuery("#clear_log_acc_submit").click(function(e) {
	e.preventDefault();
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_delete_admaccess_acc.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
});

}); // end document.ready// JavaScript Document