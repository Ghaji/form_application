<?php 
require_once("inc/initialize.php"); 
 
if(!$session->is_logged_in())
{
	redirect_to('index.php');
}

$user = new User();

$user->applicant_id = $session->applicant_id;

$form_id = $user->get_form_id();

$sql = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$form_id."' AND `reg_num`='".$form_id."'";

$payment_record = $user->find_by_sql($sql);

if(empty($payment_record))
{
	redirect_to('select_form.php');
}

$student_status = $user->get_student_status();

$database = new MYSQLDatabase();

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
	.imgg{display:none;}
</style>
</head>
<body>
<?php include_layout_template("header.php"); ?> 
<div class="noprint">
<?php include_layout_template("confirmation_menu.php"); ?> 
</div> 

<!--The Main Content Here Please-->

<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
    	<div class="span8 create offset2" style="text-align:center;">
        <?php
			$sqlprogrammedetails = "SELECT * FROM personal_details p, department d, faculty f WHERE p.applicant_id=".$session->applicant_id." AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id";
			$programmedetails = $database->fetch_array($database->query($sqlprogrammedetails));
			$sessiondetails = $database->fetch_array($database->query("SELECT session FROM application_status WHERE id=1"));
			$paymentdetails = $database->fetch_array($database->query("SELECT * FROM adm_access_code WHERE jamb_rem_no='".$programmedetails['form_id']."'"));
		?>
        
            <table class="table table-bordered">
            
            <tr>
<td colspan="2" ><h4 align="center">APPLICATION FORM RECEIPT FOR <?= $sessiondetails['session']; ?> ACADEMIC SESSION</h4> </td>
                    
                </tr>
            
            	<tr>
                	<td>Name: </td>
                    <td><?= $programmedetails['surname'].' '.$programmedetails['first_name'].' '.$programmedetails['middle_name']; ?></td>
                </tr>
                
                <tr>
                	<td>Application Number: </td>
                    <td><?= $programmedetails['form_id']; ?></td>
                </tr>
                
                <tr>
                	<td>Programme: </td>
                    <td><?= $programmedetails['faculty_name']; ?></td>
                </tr>
                
                 <tr>
                	<td>Course: </td>
                    <td><?= $programmedetails['department_name']; ?></td>
                </tr>
                
                 <tr>
                	<td>Programme Amount: </td>
                    <td><?= $paymentdetails['amount']; ?></td>
                </tr>
                
                <tr>
                	<td>Access Code: </td>
                    <td><?= $paymentdetails['pin']; ?></td>
                </tr>
                
                <tr>
                	<td>Transaction Date: </td>
                    <td><?= $paymentdetails['payment_date']; ?></td>
                </tr>
                 <tr class="noprint">
                	<td></td>
                    <td><button class="btn btn-primary " onClick="window.print();" >PRINT</button></td>
                </tr>
            </table>
            
            <img src="/mis.unijos.edu.ng/app_form_template/images/logo.png" class="imgg">
        </div>
    </div>
</div>

<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/dropdownscript.js"></script>
<script src="js/nav_tabs.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>