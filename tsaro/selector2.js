jQuery(document).ready(function(){

var faculty_id = jQuery('#faculty_id').val();

var department_from_db = jQuery('#department_from_db').val();

get_options(faculty_id);
//end of things to be done on page load

jQuery('#faculty_id').change(function(){
	get_options(jQuery(this).val());	
});

function get_options(id) {

    document.getElementById('department_id').innerHTML='<option>Loading...</option>';
    var xmlhttp=GetXmlHttpObject();
    if (xmlhttp==null) {
        alert ("Your browser does not support AJAX!");
        return;
    }
    var date=new Date();
    var timestamp=date.getTime();
    var url="dept.php";
    //var param="state_id="+id+"&timestamp="+timestamp;
	var param="faculty_id="+id+"&dept_id="+department_from_db;
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete") {
            var res=xmlhttp.responseText;
            document.getElementById('department_id').innerHTML=res;
        }
    }
    xmlhttp.open("POST",url,true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", param.length);
    xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(param);
	
	jQuery('#department_from_db').val(0);
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
});