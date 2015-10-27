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

	function validate_activate_deactive_form(btn) {
		form_data = jQuery(".select_programme").serialize()+ "&btn=" + btn;
		jQuery.validator.setDefaults({
			submitHandler : function() {

				show_modal();
				jQuery.ajax({
					type : "POST",
					url : "ajax/ajax_toggle_activation.php",
					data : form_data
				}).done(function(msg) {
					display_modal(msg);
				});
			}
		});
		jQuery('.select_programme').validate({
			rules : {
				faculty_id : {
					required : true
				},
				department_id : {
					required : true
				},
				type_of_programme : {
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


	jQuery('#activate_submit').click(function() {
		validate_activate_deactive_form('activate_submit');
	});
	
	jQuery('#deactivate_submit').click(function() {
		validate_activate_deactive_form('deactivate_submit');
	});

});
// end document.ready