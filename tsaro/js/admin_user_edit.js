jQuery.noConflict();
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
		  url: "ajax/ajax_admin_user_edit.php",
		  data: jQuery(".admin_edit_form").serialize()
		}).done(function( msg ) {
		    display_modal(msg);
		});
	}
 }); 
 jQuery('.admin_edit_form').validate(
 {
  rules: {
    surname: {
      required: true,
	  minlength: 3
    },
	othernames: {
      required: true,
	  minlength: 3
    },
    staffid: {
      required: true,
	  minlength: 4,
	  number: 4
    },
	email: {
      required: true,
      email: true,
	  remote: "email.php"
    },
    epassword: {
	  minlength: 6
	},
	cepassword: {
	  minlength: 6,
	  equalTo: "#epassword"
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
	
	jQuery('#role').change(function(){

		if(jQuery(this).val() == 4){
			jQuery('.department_administrator').show();
			jQuery('#faculty_id').attr('required', 'required');
			jQuery('#department_id').attr('required', 'required');
		}else{
			jQuery('.department_administrator').hide();
			jQuery('#department_id').removeAttr('required');
			jQuery('#faculty_id').removeAttr('required');
		}
	});
	
}); // end document.ready