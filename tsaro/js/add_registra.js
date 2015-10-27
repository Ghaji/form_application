// JavaScript Document
jQuery.noConflict();
jQuery(document).ready(function() {

	jQuery("#close").click(function() {
		jQuery(".modal").modal("hide");
	});

	jQuery("#done").click(function() {
		//alert("You clicked Done");
		//jQuery("#done").load('index.php');

		jQuery(".modal").modal("hide");
	});

	function show_modal() {
		jQuery(".modal-body").html("<center class='loading'>Loading Please Wait...</center>");
		jQuery(".modal-body").addClass("loader");
		jQuery("#displayinfo").modal("show");
	}

	function display_modal(msg) {
		jQuery(".modal-body").removeClass("loader");
		jQuery(".modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}

	function validate_add_form(btn, form) {
		//form_data = jQuery("."+form).serialize()+ "&btn=" + btn;
		jQuery.validator.setDefaults({
			submitHandler : function() {

				show_modal();
				var fd = new FormData(document.getElementById("signature_upload"));
	            fd.append("btn", btn);
	            $.ajax({
	              url: "ajax/ajax_registra.php",
	              type: "POST",
	              data: fd,
	              enctype: 'multipart/form-data',
	              processData: false,  // tell jQuery not to process the data
	              contentType: false   // tell jQuery not to set contentType
	            }).done(function( data ) {
	                display_modal(data);
	            });
			}
		});

		jQuery('.'+form).validate({
			rules : {
				full_name : {
					required : true
				},
				year : {
					required : true
				},
				signature_image : {
					required : true
				}
			},
			errorClass : "help-inline",
			highlight : function(label) {
				jQuery(label).closest('.control-group').removeClass('success').addClass('error');
			},
			success : function(label) {
				label.text('OK!').addClass('valid').closest('.control-group').addClass('success');
			}
		});
	}

	// function validate_del_form(btn) {
	// 	form_data = jQuery(".edit-reason").serialize()+ "&btn=" + btn;
	// 	jQuery.validator.setDefaults({
	// 		submitHandler : function() {

	// 			show_modal();
	// 			jQuery.ajax({
	// 				type : "POST",
	// 				url : "ajax/ajax_set_ineligible_reasons.php",
	// 				data : form_data
	// 			}).done(function(msg) {
	// 				display_modal(msg);
	// 			});
	// 		}
	// 	});
	// 	jQuery('.edit-reason').validate({
	// 		rules : {
	// 			reason : {
	// 				required : true
	// 			}
	// 		},
	// 		errorClass : "help-inline",
	// 		highlight : function(label) {
	// 			jQuery(label).closest('.control-group').removeClass('success').addClass('error');
	// 		},
	// 		success : function(label) {
	// 			label.text('OK!').addClass('valid').closest('.control-group').addClass('success');
	// 		}
	// 	});
	// }

	jQuery('#add_registra').click(function() {
		validate_add_form('add_registra', 'add_registra');
	});

	jQuery('#update_registra').click(function() {
		validate_add_form('update_registra', 'update_registra');
	});

	jQuery('#del_registra').click(function() {
		form_data = jQuery(".update_registra").serialize()+ "&btn=del_registra";
		console.log(form_data);
		show_modal();
		jQuery.ajax({
			type : "POST",
			url : "ajax/ajax_registra.php",
			data : form_data
		}).done(function(msg) {
			display_modal(msg);
		});
	});

});
// end document.ready