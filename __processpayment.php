<?php 
	require_once("inc/initialize.php");
	
	if(!isset($_POST['txnref'])){
		redirect_to("index.php");
	}
	
	require_once("inc/ajiya/webservice.php");
	
	$transctiondetails = checkTranxact(getStatus($_SESSION["transaction_id"]));
	$applicant = User::find_by_id($session->applicant_id);
	
	$database = new MYSQLDatabase();
	$sqlprogrammedetails = "SELECT `faculty_name`,`department_name` FROM personal_details p, department d, faculty f WHERE p.applicant_id=".$_SESSION["applicant_id"]." AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id";
	$programmedetails = $database->fetch_array($database->query($sqlprogrammedetails));
	$sessiondetails = $database->fetch_array($database->query("SELECT session FROM application_status WHERE id=1"));
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
<style type="text/css">
	@media print{
		.noprint{display:none}
		.imgg{
			margin-top:-400px; 
			opacity:0.1; 
			width:200px; 
			display:inline-block !important;
			}
		
	}
	/*.imgg{display:none;}*/
</style>
<script src="css/assets/js/jquery.js"></script> 
</head>
<body onLoad="updateLogTranx();">
<?php include_layout_template("header.php"); ?>
<!-- beginnning of main content -->
<div class="container">
    <div class="row-fluid">
    	<div class="span8 create">
        	<div id="displayer">
	            <h3 style="color:#666">Finalizing Payment... Please Do Not
	            <strong class="red">Close</strong> this Window yet!</h3>
	            <img src="css/assets/img/ajax-loader_004.gif"  />
	        </div>
	    </div>
    </div>
</div>
<!-- end of main content -->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<script type="text/javascript">
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
			req = new ActiveXObject("Msxml2.XMLHTTP");

		}
		catch(err2)
		{
			try
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
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

var transaction_response_code = "<?php echo $transctiondetails['ResponseCode']; ?>";
var name = "<?php echo $applicant->surname.' '.$applicant->first_name.' '.$applicant->middle_name; ?>";
var form_number = "<?php echo $applicant->form_id; ?>";
var amount = "<?php echo $transctiondetails['Amount']; ?>";
var transaction_date = "<?php echo $transctiondetails['TranxDate']; ?>";
var CardNumber = "<?php echo $transctiondetails['CardNumber']; ?>";
var access_code = "<?php echo $_SESSION["transaction_id"]; ?>";
var RetRefNumb = "<?php echo $transctiondetails['RetRefNumb']; ?>";
var merchant = "<?php echo $transctiondetails['PaymentReference']; ?>";
var response_description = "<?php echo $transctiondetails['ResponseDescription']; ?>";

var programme = "<?php echo $programmedetails['faculty_name']; ?>";
var course = "<?php echo $programmedetails['department_name']; ?>";
var academic_session = "<?php echo $sessiondetails['session']; ?>";

function updateLogTranx(){
	param = "action=updateit&rnd=myRandom&Amount="+ amount +"&ResponseCode="+ transaction_response_code +"&CardNumber="+ CardNumber +"&RefNumb="+ access_code +"&RetRefNumb="+ RetRefNumb +"&TranxDate="+ transaction_date +"&ResponseDescription="+ response_description +"&PaymentReference="+ merchant;
	
	myRequest.open("POST", "inc/ajiya/ws_ajax.php", true);
	
	myRequest.onreadystatechange = responseAjax;
	myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	myRequest.send(param);
}

function responseAjax() {
	if(myRequest.readyState == 4) {
		//alert(myRequest.responseText);
		if(myRequest.status == 200 && myRequest.responseText == "done") {
			console.log(myRequest.responseText);
			//bye();
		} else {
			//alert("An error has occurred: " + myRequest.responseText);
		}
	}
}
	
	if(transaction_response_code=='00'){
		document.getElementById("displayer").innerHTML = "<table class=\"table table-bordered\"><tr><td colspan=\"2\" ><h4 align=\"center\">PAYMENT CONFIRMATION FOR APPLICATION FORM "+academic_session+" ACADEMIC SESSION</h4> </td></tr><tr><td>Name: </td><td>"+ name +"</td></tr><tr><td>Application Number: </td><td>"+ form_number +"</td></tr><tr><td>Programme: </td><td>"+ programme +"</td></tr><tr><td>Course: </td><td>"+ course +"</td></tr><tr><td>Programme Amount: </td><td>"+ amount +"</td></tr><tr><td>Access Code: </td><td>"+ access_code +"</td></tr><tr><td>Transaction Date: </td><td>"+ transaction_date +"</td></tr><tr class='noprint'><td></td><td><a href='invoice.php' class='btn btn-primary'>CLICK HERE TO PRINT YOUR INVOICE</a></td></tr></table><center><img src='/mis.unijos.edu.ng/app_form_template/images/logo.png' class='imgg'></center>";
		
		param = "action=insertaccesscode&rnd="+myRandom+"&Amount="+ amount +"&ResponseCode="+ transaction_response_code +"&CardNumber="+ CardNumber +"&RefNumb="+ access_code +"&RetRefNumb="+ RetRefNumb +"&TranxDate="+ transaction_date +"&ResponseDescription="+ response_description +"&PaymentReference="+ merchant;

		myRequest.open("POST", "inc/ajiya/ws_ajax.php", true);

		myRequest.onreadystatechange = responseAjax;
		myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		myRequest.send(param); 

	}else{
		jQuery('#displayer').html("<center><h3><u><b>The Payment with Transaction ID: "+ access_code +"<br><font color=red>Failed</font></b></u></h3></centre><br /><table rules=rows align=center cellspacing=10><tr><td align=\'left\' ></td><td align=\'left\'><font color=red> "+ response_description +" </font></td></tr><tr><td align=\'left\' colspan=2 ></td></tr></table>");
	}

 var form;
 var papa =  window.opener;

function bye(){

if(window.opener && !window.opener.closed) {
	// alert(papa);

//window.opener.location.href = "";
}else{

	badidea = window.open("","University of Jos Charges Payment System" )


		form.target = badidea;

		badidea.focus();
	}

  window.close();
}

</script>
<?php
	//unset($_SESSION["transaction_id"]);
	unset($_SESSION['course']);
	unset($_SESSION['programme']);
?>