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
	
	var admission_status_wrapper = jQuery("#admission_status_wrapper"),
		set_admission_status = jQuery("#set_admission_status");
	
	var currentpage = 1;
	var nextpage, prevpage, numberofpages;

	jQuery('#submit').click(function(e){
		e.preventDefault();
		jQuery('.pagination').hide();
		admission_status_wrapper.hide();
		set_admission_status.hide();
		jQuery('#view_div').html('Loading...');
		jQuery.ajax({
			type:'POST',
			url:'ajax/ajax_view.php',
			data: jQuery(".view_applicant_form").serialize()	
		}).done(function(value){
			currentpage = 1;
			var value = value.split('pagenumber=');
			jQuery('#view_div').html(value[0]);
			numberofpages_and_export = value[1];
			var numberofpages_and_export = numberofpages_and_export.split('export=');
			numberofpages = numberofpages_and_export[0];
			var exportdata = numberofpages_and_export[1];
			jQuery("#pageNumber").attr("max",numberofpages);
			if(numberofpages != 0)
			{
				jQuery('.pagination').show().parent().removeClass('active');
				pagination(currentpage);
			}
			jQuery('#exportdata').attr('value', exportdata);
			jQuery('#exportdatabutton').show();
			admission_status_wrapper.show();
			set_admission_status.show();
			jQuery("#check").show();
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
	
	jQuery("#set_admission_status").click(function() {
		show_modal();
		jQuery.ajax({
		  type: "POST",
		  url: "ajax/ajax_admission_multiple.php",
		  data: jQuery('.admission_multiple').serialize()
		}).done(function( msg ) {
		    display_modal(msg);
		});
	});
	
	//on checking select all
	jQuery('#check_all').click(function (){
		if(jQuery('#check_all').is(':checked')){
			jQuery('input[type=checkbox]:not(#check_all)').attr('checked', 'checked');
		}else{
			jQuery('input[type=checkbox]:not(#check_all)').removeAttr('checked');
		}
		
	});
	
});