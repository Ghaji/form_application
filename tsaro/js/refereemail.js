jQuery.noConflict();
jQuery(document).ready(function(){
	
	var formclass = jQuery('.refereeMail');
	
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
 jQuery.validator.setDefaults({
	submitHandler: function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_refereemail.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	}
 }); 
 jQuery(formclass).validate(
 {
  rules: {
	email: {
      required: true,	  
      remote:'email2.php'
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
 
}); // end document.ready// JavaScript Document