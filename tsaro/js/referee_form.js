/*---------------------- Modal -------------------------------------*/
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
		//jQuery(".modal .ajax_data").html("<pre>"+msg+"</pre>");
		//jQuery(".modal").modal("show");
		jQuery(".modal-body").removeClass("loader");
		jQuery(" .modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}
	/*--------------------------------------------------------------------*/
	
	
	/*----------------------- Validations -------------------------------------------------------*/
	function validate_referee_form() {
		jQuery('.referee_form').validate(
		 {
		  rules: {
		  	referee_rank: {
		      required: true,
		   	},
		   	address: {
		      required: true,
		      minlength: 5
		   	},
		   	job_description: {
		      required: true,
		      minlength: 5
		   	},
		   	how_long: {
		   	  required: true,
		   	},
		   	whatcapacity: {
		      required: true,
		   	},
		   	comment: {
		      required: true,
		      minlength: 5
		   	},
		   	rank_candidate: {
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
	}
	//end of the validation for the referee form tab
	
	//validate function for referee form tab in diploma
	
	
	/*-------------------- End of Validations ----------------------------------------------------*/
	
	
	
	/*---------------------- Save buttons --------------------------------------------------------*/
	$('#referee_form_submit').click(function(){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_refereeform.php",
			  data: jQuery(".referee_form").serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		 
		validate_referee_form();
	});
	//end of the submit button for referee.form being clicked
	
});