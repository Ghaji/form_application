<?php 
	require_once("inc/initialize.php");
	require_once("inc/remita_functions.php");
	
	// if(!isset($_POST['txnref'])){
	// 	redirect_to("index.php");
	// }
	
	# Get transaction details (for transaction stored in session) from remita
	$transctiondetails = remita_transaction_details($_SESSION["transaction_id"]);

	// print_r($transctiondetails);

	$applicant = User::find_by_id($session->applicant_id);

	$applicant_fullname  = $applicant->surname.' '.$applicant->first_name.' '.$applicant->middle_name;
	
	$database = new MYSQLDatabase();
	$sqlprogrammedetails = "SELECT `faculty_name`,`department_name` FROM personal_details p, department d, faculty f WHERE p.applicant_id=".$_SESSION["applicant_id"]." AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id";
	$programmedetails = $database->fetch_array($database->query($sqlprogrammedetails));
	$sessiondetails = $database->fetch_array($database->query("SELECT session FROM application_status WHERE id=1"));

	$orderId                = $transctiondetails["orderId"];
    $tranxTime              = $transctiondetails["transactiontime"];
    $RRR                    = $transctiondetails["RRR"];
    $ResponseCode           = $transctiondetails["status"];
    $ResponseDescription    = $transctiondetails["message"];

    # Instance of Acceptance
    $acc = new AcceptanceLog();

    # Get id for acceptance_log record 
    $sql_acceptance_log = "SELECT id FROM `acceptance_log` WHERE PaymentReference='".$orderId."' LIMIT 1";
    $acceptance_log = $acc->find_by_sql($sql_acceptance_log);
    $log = array_shift($acceptance_log);

    $acc_id         = $log->id;
    
    if (isset($_SESSION['amount'])) {
    	$amount = $_SESSION['amount'];
    }

    if (isset($_SESSION['student_status'])) {
    	$student_status = $_SESSION['student_status'];
    }
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
	.imgg{
		margin-top:-400px; 
		opacity:0.1; 
		width:200px; 
		display:inline-block !important;
	}
</style>
<script src="css/assets/js/jquery.js"></script> 
</head>
<body>
<?php include_layout_template("header.php"); ?>
<!-- beginnning of main content -->
<div class="container">
    <div class="row-fluid">
    	<!-- <div class="span4 create">
        	<div id="displayer">
	            <h3 style="color:#666">Finalizing Payment... Please Do Not
	            <strong class="red">Close</strong> this Window yet!</h3>
	            <img src="css/assets/img/ajax-loader_004.gif"  />
	        </div>
	    </div> -->
	    <br><br>
	    <div class="span10 offset1">
	    	<?php
	    		# ------------- Update acceptance_log table ----------------------------  
                # Instance of Acceptance
                $acceptance = new AcceptanceLog();  
                $acceptance->db_fields = array('ResponseCode', 'ResponseDescription');

                # Assign properties to acceptance_log object in preperation for log update    
                $acceptance->ResponseCode           = $ResponseCode;
                $acceptance->ResponseDescription    = $ResponseDescription;
                
                if(!empty($acc_id)){
                    $acceptance->id                 = $acc_id;
                }

                # Save Record into Table acceptance_log
                $acceptance->save(); 

                if($transctiondetails['message'] == 'Approved' && $transctiondetails['status'] == '01' || $transctiondetails['status'] == '00') {
                    $sql = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$orderId."'";
                    $payment = AdmAccess::find_by_sql($sql);
                    $payment_record = array_shift($payment);

                    # Check payment record to avoid duplicate entry into adm_access_code table on page refresh
                    if(empty($payment_record)) {
                        # ------------- Update adm_access_code table ---------------------------- 

                        # Instance of AdmAccess
                        $adm = new AdmAccess();
                      
                        $adm->jamb_rem_no   = $applicant->form_id;
                        $adm->amount        = $amount;
                        $adm->payment_date  = $tranxTime;
                        $adm->payment_code  = $RRR;
                        $adm->reg_num       = $applicant->form_id;
                        $adm->pin           = $orderId;
                        $adm->full_name     = $applicant_fullname;
                        $adm->status 		= $student_status;
                        
                        # Save record into adm_access_code table
                        $adm->save();
                    }
	    	?>
	    			<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th colspan="2"><h4 align="center">Payment Confirmation for Application Form <?php echo $sessiondetails['session']; ?> Academic Session</h4></th>
							</tr>
						</thead>
						<tbody data-provides="rowlink">
							<tr class="rowlink">
								<td>Name</td>
								<td><?php echo $applicant_fullname; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Application Form Number</td>
								<td><?php echo $applicant->form_id; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Amount</td>
								<td>&#8358;<?php if(isset($amount)) echo $amount; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Transaction Time</td>
								<td><?php echo $tranxTime; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Access Code</td>
								<td><?php echo $orderId; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Programme</td>
								<td><?php echo $programmedetails['faculty_name']; ?></td>
							</tr>

							<tr class="rowlink">
								<td>Course</td>
								<td><?php echo $programmedetails['department_name']; ?></td>
							</tr>

							<tr class="nolink">
								<td></td>
								<td><a href='invoice.php' class='btn btn-primary'>CLICK HERE TO PRINT YOUR INVOICE</a></td>
							</tr>
						</tbody>
					</table>
					<center><img src='images/logo.png' class='imgg'></center>
					
	    	<?php
	    		} else {
	    	?>
	    			<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th colspan="2">University of Jos</th>
							</tr>
						</thead>
						<tbody data-provides="rowlink">
							<tr class="rowlink">
								<td>The Payment with Transaction ID: </td>
								<td><?php $msg = $transctiondetails['orderId']; echo output_message($msg); ?></td>
							</tr>
						</tbody>

					</table>
			<?php
	    		}
	    	?>
	    </div>
    </div>
</div>
<!-- end of main content -->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function(){
		
		jQuery("#close").click(function(){
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

</script>
<?php
	//unset($_SESSION["transaction_id"]);
	unset($_SESSION['amount']);
	unset($_SESSION['student_status']);
?>