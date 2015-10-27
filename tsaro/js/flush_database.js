jQuery.noConflict();
jQuery(document).ready(function(){
 //jQuery('.textarea').wysihtml5();
 
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
		jQuery(".modal-body").removeClass("loader");
		jQuery(" .modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}
 
	jQuery("#flush_db").click(function(e) {
	 	e.preventDefault();
	 	//alert('clicked');
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_flush_db.php",
		  data: jQuery(".flush").serialize()
		}).done(function( msg ) {
			display_modal(msg);
		});
	})
}); // end document.ready