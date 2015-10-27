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

	var currentpage = 1,
		numberofpages = jQuery("#pg_num").val(),
		nextpage, prevpage;
		
	pagination(currentpage);
	
	jQuery('.next').click(function(){
		jQuery(this).tab('show').parent().removeClass('active');
		currentpage = currentpage + 1;
		pagination(currentpage);
	});	
	jQuery('.prev').click(function(){
		jQuery(this).tab('show').parent().removeClass('active');
		currentpage = currentpage - 1;
		pagination(currentpage);
	});
	
	function pagination(currentpage)
	{
		nextpage = '#'+(currentpage+1);
		prevpage = '#'+(currentpage-1);
		jQuery('.pagination .next').attr('href', nextpage).parent().show();
		jQuery('.pagination .prev').attr('href', prevpage).parent().show();
		if(currentpage == numberofpages){
			jQuery('.pagination .next').parent().hide();
		}

		else if(currentpage == 1){
			jQuery('.pagination .prev').parent().hide();
		}
		
		else{
			jQuery('.pagination .next').parent().show();
		}
		jQuery('li .add-on').html(currentpage+" of "+numberofpages);
	}
});