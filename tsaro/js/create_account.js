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
		  url: "ajax/server.php",
		  data: jQuery(".create_form").serialize()
		}).done(function( msg ) {
		    display_modal(msg);
		});
	}
 }); 
 jQuery('.create_form').validate(
 {
  rules: {
    sname: {
      required: true,
	  minlength: 3
    },
	fname: {
      required: true,
	  minlength: 3
    },
	mname: {
      required: false,
	  minlength: 3
    },
    phone: {
      required: true,
	  //number: 13,
	  minlength: 11	
    },
	email: {
      required: true,
      email: true,
	  remote: "email.php"
    },
    epassword: {
	  required: true,
	  minlength: 6
	},
	cepassword: {
	  required: true,
	  minlength: 6,
	  equalTo: "#epassword"
	},
	captcha: {
	 required: true,
	 remote: "process.php"
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
 
  jQuery("#refreshimg").click(function(){
		jQuery.post('newsession.php');
		jQuery("#captchaimage").load('image_req.php');
		return false;
	});
	
	//code to hide topic selection, disable for demo
  jQuery("#terms").click(function() {
  jQuery("#captcha").attr("disabled", !this.checked);
  jQuery("#submit").attr("disabled", !this.checked);
});
	
	
}); // end document.ready