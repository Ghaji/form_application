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
	
	add_theme = jQuery('.add_theme');
	function validate_add_theme() {
		
		add_theme.validate(
		 {
		  rules: {
		  	institution_name: {
		      required: true
		   },
		   institution_caption: {
		      required: true
		   	},
		   institution_text_color: {
		      required: true
		   	},
		   institution_caption_text_color: {
		      required: true
		   	},
		   header_bg_color: {
		      required: true
		   	},
		   logo_name: {
		      required: true
		   	},
		   logo_caption: {
		      required: true
		   	},
		   site_url: {
		      required: true
		   	},
		   status: {
		      required: true
		   	},
		   visible: {
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

	$('#create_theme').click(function(){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			var fd = new FormData(document.getElementById("add_theme"));
			fd.append("label", "WEBUPLOAD");
			
			var other_data = add_theme.serialize();
			jQuery.each(other_data, function(key, input){
				fd.append(input.name, input.value);
			});
			
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_theme.php",
			  data: fd,
			  enctype: 'multipart/form-data',
			  processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
			}).done(function( msg ) {
				display_modal(msg);
			});
			}
		 });
		 
		validate_add_theme();
	});
	
}); // end document.ready