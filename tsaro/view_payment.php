<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

// if($_SESSION["role"] != 1 || $_SESSION["role"] != 6){
	// redirect_to('home.php');
// }
$database = new MySQLDatabase();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>University of Jos, Nigeria</title>
		<?php
		require_once (LIB_PATH . DS . 'css.php');
		?>
        <link rel="stylesheet" href="js/plugins/datetimepicker/jquery.datetimepicker.css">
	</head>

	<body>

		<!-- beginnning of main content-->
		<!-- header -->
		<?php
		include_layout_template('admin_header.php');
		?>
		<!-- //header -->
		<br>
		<br>

		<!-- Content -->
		<div class="row-fluid">

			<?php
			include_layout_template('admin_menu.php');
			?>

			<div class="span9">
				<h2>Transaction Log (Successful Payment)</h2>
				<hr>
						<?php 
						//$acc_log = new AcceptanceLog();
						$result = AdmAccess::find_by_sql("SELECT * FROM `adm_access_code` WHERE `jamb_rem_no` = '".customDecrypt($_GET['q'])."' AND reg_num = '".customDecrypt($_GET['q'])."'");
						$result = array_shift($result);

						?>
						<!-- Begining of acceptance log form -->
				<form class="form-horizontal adm_access_details">
					<input type="hidden" name="adm_id" value="<?php echo $result->id; ?>"/>
					<div class="control-group">
						<label class="control-label">Application Number</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" readonly name="applicant_number" placeholder="Applicant Number" class="input-xlarge" value="<?php echo $result->jamb_rem_no; ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Access Code</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" required="required" name="access_code" placeholder="Access Code" class="input-xlarge" value="<?php echo $result->pin; ?>" />
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="amount" id="amount" >
                                <?php
									$naira = '&#8358;';
									
									$arrayAmount = $database->query("SELECT * FROM form_amount WHERE status=1");

									while($row = $database->fetch_array($arrayAmount)){
										$amountformat = ($row['amount'] * 100).'.00';
										if($amountformat == $result->amount){
											echo '<option selected="selected" value="'.$row['amount'].'">'.$naira.$row['amount'].'</option>';
										}else{
											echo '<option value="'.$row['amount'].'">'.$naira.$row['amount'].'</option>';
										}
									}
								?>
                                </select>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Transaction Date</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input id="datetimepicker" required="required" type="text" name="transaction_date" placeholder="YYYY-MM-DD HH:mm" class="input-xlarge" value="<?php echo $result->payment_date; ?>" />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">IP Address</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" name="ip_address" placeholder="IP Address" class="input-xlarge" value="<?php echo $result->ip_addr; ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Payment Code</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" name="payment_code" placeholder="Payment Code" class="input-xlarge" value="<?php echo $result->payment_code; ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Branch Code</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" name="branch_code" placeholder="Branch Code" class="input-xlarge" value="<?php echo $result->branch_code; ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Full Name</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="text" required="required" name="full_name" placeholder="Full Name" class="input-xlarge" value="<?php echo $result->full_name; ?>" />
							</div>
						</div>
					</div>
                    
					<div class="control-group">
						<label class="control-label">Status</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<select class="input-xlarge" name="student_status" id="student_status" >
                                <?php
									$arrayStudentStatus = array('Post Graduate'=>'PGA', 'Diploma'=>'DPA', 'Part Time'=>'PTA', 'Remedial'=>'RPA', 'Institute of Education'=>'IOE');
									foreach($arrayStudentStatus as $key=>$value){
										if($value == $result->status){
											echo '<option selected="selected" value="'.$value.'">'.$key.'</option>';
										}else{
											echo '<option value="'.$value.'">'.$key.'</option>';
										}
									}
								?> 
                                </select>
							</div>
						</div>
					</div>

					
					
					<!--Re-Query and Clear log Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">
							  	<a href="search_adm.php" class="btn btn-default" name="back_submit" id="back_submit">Back</a>  
								<button type="submit" class="btn btn-danger" name="clear_log_submit" id="clear_log_submit">Delete Record</button>
                                <button type="submit" class="btn btn-primary" name="Update" id="update">Update</button>
						      </div>
						</div>
					</div>
					<!-- End of Re-Query and Clear log Button-->
				</form>
				<!-- End of acceptance log form -->
				
			</div>
            
		</div>
		<!-- //Content -->

		<?php include_layout_template("footer.php"); ?>
	</body>
</html>

<?php
require_once (LIB_PATH . DS . 'javascript.php');
?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/admaccess_update.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="js/plugins/datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	jQuery('#datetimepicker').datetimepicker();
});
</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>