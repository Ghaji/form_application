$(document).ready(function(){
	if($('#country_id').val() != '')
	{
		get_options_state($('#country_id').val(), $('#lga_hidden').val());
		
		get_options_lga('', $('#lga_hidden').val());
	}
});
function get_options_state(id, lga_id) {
	if(id==156)
	{
		$('#state_name').removeAttr('disabled');
		document.getElementById('state_name').innerHTML='<option>Loading...</option>';
		var xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null) {
			alert ("Your browser does not support AJAX!");
			return;
		}

		var url="ajax/ajax_dropdown.php";
		
		var param="country_id="+id+"&lga_id="+lga_id;
		
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
				var res=xmlhttp.responseText;
				document.getElementById('state_name').innerHTML=res;
			}
		}
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", param.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(param);
	}
	else
	{
		var value = $('#country_id option[value='+id+']').text();
		$('#state_name').html('<option selected="selected" value='+value+'>' + value +'</option>');
		$('#lga_id').html('<option selected="selected" value='+value+'>' + value +'</option>');
		$('#state_name').attr('disabled', true);
		$('#lga_id').attr('disabled', true);
	}
}

function get_options_lga(state_id, lga_id) {
	$('#lga_id').removeAttr('disabled');
	document.getElementById('lga_id').innerHTML='<option>Loading...</option>';
	var xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null) {
		alert ("Your browser does not support AJAX!");
		return;
	}
	
	var url="ajax/ajax_dropdown.php";

	var param="state_id="+state_id+"&lga_id="+lga_id;
	
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
			var res=xmlhttp.responseText;
			document.getElementById('lga_id').innerHTML=res;
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", param.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send(param);
}

function GetXmlHttpObject() {
    var xmlhttp=null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlhttp=new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer
        try {
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlhttp;
}
// JavaScript Document