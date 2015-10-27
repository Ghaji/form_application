// JavaScript Document
jQuery(document).ready(function(){

//jQuery('#terms_cond').tooltip();
 jQuery("#close").click(function(){
	jQuery(".modal").modal("hide");
	document.load='register.php';
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
		  url:'ajax/ajax_admission.php',
		  data: jQuery(".admission").serialize()
		}).done(function( msg ) {
		    display_modal(msg);
		});
	}
 }); 
 jQuery('.admission').validate(
 {
  rules: {
    admission_status: {
      required: true,
	  number: 1
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
	
});