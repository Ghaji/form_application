jQuery.noConflict();
jQuery(document).ready(function(){
	
 jQuery("#close").click(function(){
	jQuery(".modal").modal("hide");
 });
 
 jQuery("#done").click(function(){
    //alert("You clicked Done");
	//jQuery("#done").load('index.php');

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
		  url: "inc/ajax_forgetpwd.php",
		  data: jQuery(".login").serialize()
		}).done(function( msg ) {
			
if(msg == 0){
	  jQuery(".modal .ajax_data").html("<pre>The Username and Password is wrong\n<a href='index.php'>Click to Re-Login</a> </pre>");
	  jQuery(".modal").modal("show");
}else if(msg == 2){				
	  jQuery(".modal .ajax_data").html("<pre>The Information Match but your account is not Active see the administrator. To proceed please make sure it is activated\n<a href='index.php'>Click to Exit</a> </pre>");
	  jQuery(".modal").modal("show");
}else{		
	  jQuery(".modal .ajax_data").html("<pre>Login Information Successful, Use the Link Below to continue.\n\n<a href='secure/index.php'>Continue</a></pre>");
	  jQuery(".modal").modal("show");				
}
		});
	}
 }); 
 jQuery('.login').validate(
 {
  rules: {
	username: {
      required: true,
	  minlength: 4
	  //number: true
    },
	password: {
      required: true,
	  minlength: 4
      //email: true,
	  //remote: "email.php"
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
 
}); // end document.ready