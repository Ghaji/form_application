// JavaScript Document
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
	
});