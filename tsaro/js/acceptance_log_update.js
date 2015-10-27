jQuery.noConflict();
jQuery(document).ready(function(){
	
	var formclass = jQuery('.acceptance_log_details');
	
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
	
	jQuery("#update").click(function(e) {
	 jQuery.validator.setDefaults({
		submitHandler: function() {
			show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_acceptance_update.php",
			  data: formclass.serialize()
			}).done(function( msg ) {
				display_modal(msg);
			});
		}
	 }); 
	 jQuery(formclass).validate(
	 {
	  rules: {
		applicant_number: {
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
	});//end of onclick jquery for update button

	jQuery("#clear_log_submit").click(function(e) {
		e.preventDefault();
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_delete_acceptance.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	});

	jQuery("#update_acc").click(function(e) {
	 jQuery.validator.setDefaults({
		submitHandler: function() {
			show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_acceptance_acc_update.php",
			  data: formclass.serialize()
			}).done(function( msg ) {
				display_modal(msg);
			});
		}
	 }); 
	 jQuery(formclass).validate(
	 {
	  rules: {
		applicant_number: {
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
	});//end of onclick jquery for update button

	jQuery("#clear_log_submit_acc").click(function(e) {
		e.preventDefault();
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_delete_acc_acceptance.php",
		  data: formclass.serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	});

	jQuery("#re_query_submit").click(function(e) {
		e.preventDefault();
		show_modal();
		var payment_ref = jQuery("input[name=payment_ref]").val(),
			student_id = jQuery("input[name=applicant_number]").val();
		
		logTranx(payment_ref, student_id);
		
	});
	
	function getXMLHTTPRequest()
	{
		var req = false;
		try
		{
			req = new XMLHttpRequest(); 
		}
		catch(err1)
		{
			try
			{
				req = new ActiveXObject('Msxml2.XMLHTTP');
			}
			catch(err2)
			{
				try
				{
					req = new ActiveXObject('Microsoft.XMLHTTP');
					/* some versions IE */
				}
				catch(err3)
				{
					req = false;
				}
			}
		}
		return req;
	}
	
	var myRequest = getXMLHTTPRequest();
	var myRandom=parseInt(Math.random()*99999999);
	
	function logTranx(itit, num){
	  param = 'retAction=' + itit + '&number=' + num +'&rnd=' + myRandom;
	  
	  myRequest.open('POST', '../inc/ajiya/webservice.php', true);
	  myRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	  myRequest.onreadystatechange = responseAjax;
	  
	  myRequest.send(param);	
  
  }
  
  function responseAjax() {
	  // we are only interested in readyState
	  // of 4, i.e. completed
	  //alert(myRequest.readyState);
	  
	  if(myRequest.readyState == 4) {
		  // if server HTTP response is 'OK'
		  
		  //alert(myRequest.responseText);
		  if(myRequest.status == 200) {
			  //alert(myRequest.responseText);
			  //eval(myRequest.responseText);
			  display_modal(myRequest.responseText);
			  
			  //alert(myRequest.responseText);
		  //document.getElementById('form1').submit();
			  
		  } 
		}
	  }
  
}); // end document.ready// JavaScript Document