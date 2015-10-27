// JavaScript Document
jQuery(document).ready(function(){

	//jQuery('#terms_cond').tooltip();
	 jQuery("#close").click(function(){
		jQuery(".modal").modal("hide");
		document.load='home.php';
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
	
	var currentpage = 1;
	var nextpage, prevpage, numberofpages;

	jQuery('#search_adm_access_button').click(function(e){
		e.preventDefault();
		jQuery('.pagination').hide();
		jQuery('#view_div').html('Loading...');
		jQuery.ajax({
			type:'POST',
			url:'ajax/ajax_search_adm.php',
			data: jQuery(".search_adm_access").serialize()	
		}).done(function(value){
			currentpage = 1;
			var value = value.split('pagenumber=');
			jQuery('#view_div').html(value[0]);
			numberofpages = value[1];
			jQuery("#pageNumber").attr("max",numberofpages);
			if(numberofpages > 1)
			{
				jQuery('.pagination').show().parent().removeClass('active');
				pagination(currentpage);
			} else if(numberofpages == 1){
				jQuery('.pagination').hide();
			}
		});
	});

	jQuery('#search_adm_access_acc_button').click(function(e){
		// console.log('clicked');
		e.preventDefault();
		jQuery('.pagination').hide();
		jQuery('#view_div').html('Loading...');
		jQuery.ajax({
			type:'POST',
			url:'ajax/ajax_search_adm_acc.php',
			data: jQuery(".search_adm_access").serialize()	
		}).done(function(value){
			currentpage = 1;
			var value = value.split('pagenumber=');
			jQuery('#view_div').html(value[0]);
			numberofpages = value[1];
			jQuery("#pageNumber").attr("max",numberofpages);
			if(numberofpages > 1)
			{
				jQuery('.pagination').show().parent().removeClass('active');
				pagination(currentpage);
			} else if(numberofpages == 1){
				jQuery('.pagination').hide();
			}
		});
	});

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
	
	jQuery('#pageNumber').change(function(){
		goToPage(jQuery("#pageNumber").val());
	});
	
	jQuery("#pageNumber").keyup(function() {
   		jQuery("#pageNumber").val(this.value.match(/[0-9]*/));
		goToPage(jQuery("#pageNumber").val());
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
	
	function goToPage(page)
	{
		if(page != '' && page >= 1 && page <= numberofpages){
			jQuery('#'+currentpage).removeClass('active');
			currentpage = page;
			jQuery('#'+currentpage).addClass('active');
			pagination(currentpage);
		}
	}
	
	
});