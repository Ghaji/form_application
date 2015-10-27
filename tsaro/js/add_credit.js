jQuery.noConflict();
jQuery(document).ready(function(){
	/*---------------------- Modal -------------------------------------*/
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
	
	credit = jQuery('.credit');
	function validate_credit() {
		
		credit.validate(
		 {
		  rules: {
		  	fullname: {
		      required: true
		   },
		   email: {
		      required: true
		   	}
		   	,
		   phone: {
		      required: true
		   	},
		   role: {
		      required: true
		   	},
		   aboutyou: {
		      required: true
		   	},
		   status: {
		      required: true
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

	$('#save_credit_submit').click(function(){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			var fd = new FormData(document.getElementById("credit"));
			fd.append("label", "WEBUPLOAD");
			
			var other_data = credit.serialize();
			jQuery.each(other_data, function(key, input){
				fd.append(input.name, input.value);
			});
			
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_credit.php",
			  data: fd,
			  enctype: 'multipart/form-data',
			  processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
			}).done(function( msg ) {
				display_modal(msg);
			});
			}
		 });
		 
		validate_credit();
	});
	
}); // end document.ready