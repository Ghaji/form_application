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
		form_data = jQuery("."+form).serialize()+ "&btn=" + btn;
		jQuery.validator.setDefaults({
			submitHandler : function() {

				show_modal();
				jQuery.ajax({
					type : "POST",
					url : "ajax/ajax_news.php",
					data : form_data
				}).done(function(msg) {
					display_modal(msg);
				});
			}
		});
		jQuery('.'+form).validate({
			rules : {
				title : {
					required : true
				},
				display_line : {
					required : true
				},
				content : {
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

	jQuery('#add_news').click(function() {
		validate_add_form('add_news', 'add_news');
	});

	jQuery('#update_news').click(function() {
		validate_add_form('update_news', 'update_news');
	});

	// jQuery('#del_reason').click(function() {
	// 	validate_del_form('del_reason');
	// });

});
// end document.ready